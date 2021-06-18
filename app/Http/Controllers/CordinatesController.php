<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User; //追加
use App\Cordinate; //追加
use Illuminate\Support\Str; // 追加
use \Storage; // 追加
class CordinatesController extends Controller
{
    public function index()
    {
        // 全投稿を取得
        $all = Cordinate::get();
        
        // 関係するモデルの件数を取得し、新着順に並び替え
        $cordinates = Cordinate::withCount(['favorites_users','nice_users'])
        ->orderBy('created_at','desc')->get();
        
        // 関係するモデルの件数を取得し、いいね順に並び替え
        $hotCordinates = Cordinate::withCount(['favorites_users','nice_users'])
        ->orderBy('nice_users_count','desc')->limit(3)->get();
        
        //ユーザ全数取得
        $users = User::get();

        // 関係するモデルの件数を取得
        $attentionUsers = User::withCount('followers')
        ->orderBy('followers_count','desc')->paginate(4);
        
        // welcomeビューでそれらを表示
        return view('welcome', compact('all', 'cordinates', 'hotCordinates', 'users', 'attentionUsers'));
    }
    
    public function feed()
    {
        $data = [];
        if (\Auth::check()) {
            // 全投稿を取得
            $all = Cordinate::get();
            
            // 関係するモデルの件数を取得し、新着順に並び替え
            $cordinates = Cordinate::withCount(['favorites_users','nice_users'])
            ->orderBy('created_at','desc')->get();
            
            //ユーザ全数取得
            $users = User::get();
    
            // 関係するモデルの件数を取得
            $attentionUsers = User::withCount('followers')
            ->orderBy('followers_count','desc')->paginate(4);
            
        // welcomeビューでそれらを表示
        return view('feed', compact('all', 'cordinates','users', 'attentionUsers'));
        }
    }
    
    public function show($id)
    {
        // idの値で投稿を検索して取得
        $cordinates = Cordinate::where('id',$id)->first();
        if(empty($cordinates)) {
            return \App::abort(404);
        }
        
        // 関係するモデルの件数を取得
        $favorites_users = $cordinates->loadCount(['favorites_users','nice_users']);
        
        // 詳細ビューでそれを表示
        return view('cordinates.show',  compact('cordinates', 'favorites_users',));
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
        // 画像のアップロード
        $image = $request->file('image');
        $disk = Storage::disk('s3');
        // 画像の名前をランダム8桁＋元ファイル拡張子にする
        $imageName = Str::random(8).'.'.$image->getClientOriginalExtension();
        // 画像をバケットのcordinatesフォルダに保存する
        $path = $disk->putFileAs('cordinates', $image, $imageName, 'public');
        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->cordinates()->create([
            'image' => $path,
            'text' => $request->text,
        ]);
        // 作成した画面に遷移する
        return redirect('cordinates/'.$request->id);
    }
    
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $cordinate = Cordinate::findOrFail($id);

        // 編集ビューでそれを表示
        return view('cordinates.edit', [
            'cordinates' => $cordinate,
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