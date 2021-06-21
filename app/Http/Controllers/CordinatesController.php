<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User; //追加
use App\Cordinate; //追加
use App\Tag; //追加
use Illuminate\Support\Str; // 追加
use \Storage; // 追加
class CordinatesController extends Controller
{
    public function index()
    {
        // 全投稿のクリップ件といいね件数を取得し、新着順に並び替え（#NEW用）
        $cordinates = Cordinate::withCount(['favorites_users','nice_users'])
        ->orderBy('created_at','desc')->get();
        
        // 全投稿のクリップ件数といいね件数を取得し、いいね降順に並び替え、上位３投稿まで取得（#HOT用）
        $hotCordinates = Cordinate::withCount(['favorites_users','nice_users'])
        ->orderBy('nice_users_count','desc')->limit(3)->get();
        
        // 全ユーザのフォロワー降順に取得（#人気ユーザ用）
        $attentionUsers = User::withCount('followers')
        ->orderBy('followers_count','desc')->paginate(4);
        
        // 全タグの投稿との紐づけ降順に取得（#注目タグ用）
        $hotTags = Tag::withCount('cordinates')
        ->orderBy('cordinates_count','desc')->limit(6)->get();
        
        // welcomeビューでそれらを表示
        return view('welcome', compact('cordinates', 'hotCordinates', 'attentionUsers', 'hotTags'));
    }
    
    public function feed()
    {
        if (\Auth::check()) {
            // 認証済みユーザ（閲覧者）を取得
            $user = \Auth::user();
            
            //ユーザとフォロー中の投稿の一覧を作成日時の降順で取得(タイムライン用)
            $cordinates = $user->feed_cordinates()->withCount(['favorites_users','nice_users'])
            ->orderBy('created_at','desc')->get();
            
            // 全ユーザのフォロワー降順に取得（人気ユーザ用）
            $attentionUsers = User::withCount('followers')
            ->orderBy('followers_count','desc')->paginate(4);
        
            // 全タグの投稿との紐づけ降順に取得（#注目タグ用）
            $hotTags = Tag::withCount('cordinates')
            ->orderBy('cordinates_count','desc')->limit(6)->get();
        
        // feedビューでそれらを表示
        return view('feed', compact('user', 'cordinates', 'attentionUsers','hotTags'));
        } else {
            return  view('login');
        }
    }
    
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        if (!empty($keyword))
        {
            $cordinates = Cordinate::where('text', 'like', '%' . $keyword . '%')
            ->orWhereHas('tags', function ($query) use ($keyword){
                $query->where('tag', 'like', '%' . $keyword . '%');
            })
            ->get();
        } else {
            return redirect('/');
        }
        
        // 全ユーザのフォロワー降順に取得（#人気ユーザ用）
        $attentionUsers = User::withCount('followers')
        ->orderBy('followers_count','desc')->paginate(4);
        
        // 全タグの投稿との紐づけ降順に取得（#注目タグ用）
        $hotTags = Tag::withCount('cordinates')
        ->orderBy('cordinates_count','desc')->limit(6)->get();
        
        return view('search', compact('cordinates', 'attentionUsers', 'keyword', 'hotTags'));
    }
    
    public function show($id)
    {
        // idの値で投稿を検索して取得
        $cordinate = Cordinate::where('id', $id)->first();
        if(empty($cordinate)) {
            return \App::abort(404);
        }
        
        // 関係するモデルの件数を取得
        $action_users = $cordinate->loadCount(['comments','favorites_users','nice_users']);
        
        // 詳細ビューでそれを表示
        return view('cordinates.show',  compact('cordinate', 'action_users'));
    }
    
    public function create()
    {
        $cordinate = new Cordinate;
        // コーディネート作成ビューを表示
        return view('cordinates.create', [
            'cordinate' => $cordinate,
        ]);
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'image' => ['required', 'file', 'max:2048'],
            'text' => ['string', 'nullable'],
        ]);
        
        // #ハッシュタグ毎に$request->tagsの値が$match[1]に配列で挿入される。
        $tags = [];
        preg_match_all('/#([ぁ-んァ-ヶ一-龥々０-９ａ-ｚＡ-Ｚー・a-zA-Z0-9\-]+)/u', $request->tags, $match);
        // $match[1]配列を$tagで展開
        foreach ($match[1] as $tag) {
            // すでに$tagタグがあれば取得し、なければ新規作成する。
            $record = Tag::firstOrCreate(['tag' => $tag]);
            // $recordを$tags配列に追加
            array_push($tags, $record);
        };
        // 投稿に紐づけされるタグのidを配列で取得
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag['id']);
        };

        // 画像のアップロード
        $image = $request->file('image');
        $disk = Storage::disk('s3');
        // 画像の名前をランダム8桁＋元ファイル拡張子にする
        $imageName = Str::random(8).'.'.$image->getClientOriginalExtension();
        // 画像をバケットのcordinatesフォルダに保存する
        $path = $disk->putFileAs('cordinates', $image, $imageName, 'public');
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $post = $request->user()->cordinates()->create([
            'image' => $path,
            'text' => $request->text,
        ]);

        // 投稿にタグを紐づけ
        $post->tags()->attach($tags_id);
        
        // 作成した画面に遷移する
        return redirect()->route('cordinates.show', $post->id);
    }
    
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $cordinate = Cordinate::findOrFail($id);
        
        //前タグを参照し$beforeに配列で展開
        $before = [];
        foreach($cordinate->tags as $tag){
            array_push($before, '#'.$tag->tag);
        }
        //配列を文字列に変換
        $tags = implode($before);
        
        // 編集ビューでそれを表示
        return view('cordinates.edit', [
            'cordinates' => $cordinate,
            'tags' => $tags,
        ]);
    }

    public function update(Request $request, $id)
    {
        // idの値でメッセージを検索して取得
        $cordinate = Cordinate::findOrFail($id);
        
        //アップデート時のバリデーション
        $request->validate([
            'image' => ['file', 'nullable'],
            'text' => ['string', 'nullable'],
         ]);
        
        // プロフィール画像のアップロード
        $image = $cordinate->image;
        
        if(!is_null($request->file('image'))) {
            
            //前画像を削除
            Storage::disk('s3')->delete($image);
            
            $image = $request->file('image');
            $disk = Storage::disk('s3');
            
            // 画像の名前をランダム8桁＋元ファイル拡張子にする
            $imageName = Str::random(8).'.'.$image->getClientOriginalExtension();
            // 画像をバケットのcordinatesフォルダに保存する
            $path = $disk->putFileAs('cordinates', $image, $imageName, 'public');

            $cordinate->image = $path;
            $cordinate->save();
        }
        
        $cordinate->text = $request->text;
        $cordinate->save();
    
        // 詳細へリダイレクトさせる
        return redirect('cordinates/'.$cordinate->id);
    }
    
    public function addtags(Request $request,$id)
    {
        // idの値でメッセージを検索して取得
        $cordinate = Cordinate::findOrFail($id);
        
        // #ハッシュタグ毎に$request->tagsの値が$match[1]に配列で挿入される。
        preg_match_all('/#([ぁ-んァ-ヶ一-龥々０-９ａ-ｚＡ-Ｚー・a-zA-Z0-9\-]+)/u', $request->tags, $match);
        
        //新タグを登録
        $after = [];
        foreach($match[1] as $tag) {
            $record = Tag::firstOrCreate(['tag' => $tag]);
            array_push($after, $record);
        }
        $tags_id = [];
        foreach($after as $tag) {
            array_push($tags_id, $tag->id);
        }
        
        //投稿のタグを追加する
        $cordinate->tags()->attach($tags_id);
        
        return redirect()->route('cordinates.edit', $cordinate->id);
    }
    
    public function deletetags($id,$tag)
    {
        // idの値でメッセージを検索して取得
        $cordinate = Cordinate::findOrFail($id);
        
        $tag_name = Tag::where('tag',$tag)->first(); 
        $tag_id = $tag_name->id;
        
        $cordinate->tags()->detach($tag_id);
        
        return redirect()->route('cordinates.edit', $cordinate->id);
    }
    public function destroy($id)
    {
        //idの値で投稿を検索して取得
        $cordinate = \App\Cordinate::findOrFail($id);
        $cordinateImage = $cordinate->image;
        
        //認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if(\Auth::id() === $cordinate->user_id) {
            Storage::disk('s3')->delete($cordinateImage);
            $cordinate->delete();
        }
        //ユーザ詳細へリダイレクトさせる
        return redirect('users/'.\Auth::user()->user_id);
    }
}