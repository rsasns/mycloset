<?php
namespace App\Http\Controllers;
use App\Cordinate; //追加
use Illuminate\Http\Request;
use Illuminate\Support\Str; // 追加
use \Storage; // 追加
class CordinatesController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $cordinates = $user->cordinates()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'cordinates' => $cordinates,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('welcome', $data);
    }
    
    public function show($id)
    {
        // idの値で投稿を検索して取得
        $cordinates = Cordinate::findOrFail($id);

        // 詳細ビューでそれを表示
        return view('cordinates.show', [
            'cordinates' => $cordinates,
        ]);
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