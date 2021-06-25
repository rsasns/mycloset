<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// 以下追加
use App\User;
use App\Cordinate;
use \Storage;

class ManageUserController extends Controller
{
    function showUserList(){
		$user_list = User::orderBy("id", "desc")->paginate(10);
		return view("admin.user_list", [
			"user_list" => $user_list
		]);
	}
	
	function showUserDetail($id){
		$user = User::find($id);
		return view("admin.user_detail", [
			"user" => $user
		]);
	}
	
	function showCordinateList(){
		$cordinate_list = Cordinate::orderBy("id", "desc")->paginate(10);
		return view("admin.cordinate_list", [
			"cordinate_list" => $cordinate_list
		]);
	}
	
	function showCordinateDetail($id){
		$cordinate = Cordinate::find($id);
		return view("admin.cordinate_detail", [
			"cordinate" => $cordinate
		]);
	}
	
	public function cordinateDestroy($id)
    {
        // idの値でコーディネートを検索して取得
        $cordinate = Cordinate::findOrFail($id);
        $cordinateImage = $cordinate->image;
        
        // 画像を削除
        Storage::disk('s3')->delete($cordinateImage);
        // コーディネートを削除
        $cordinate->delete();
        
        $cordinate_list = Cordinate::orderBy("id", "desc")->paginate(10);
        
        return view("admin.cordinate_list", [
			"cordinate_list" => $cordinate_list
		]);
    }
    
    public function destroy($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // ユーザの投稿を検索して取得
        $userPosts = \App\Cordinate::where('user_id',$id)->get();
        if($userPosts !== null ){
            //ユーザの投稿を展開
            foreach($userPosts as $userPost) {
                //ユーザの投稿の画像をS3から削除
                $userPostImage = $userPost->image;
                Storage::disk('s3')->delete($userPostImage);
            }
        }
        
        //プロフィール画像をidの値で検索して取得
        $userImage = User::where('id',$id)->value('image');
        $userName = User::where('id',$id)->value('user_id');
        
        //プロフィール画像を削除
        if($userImage !== null) {
            //配列からファイル名を取得してS3から削除
            Storage::disk('s3')->delete('profile/'.$userName);
        }
        
        // 取得したユーザを削除
        $user->delete();
        
        $user_list = User::orderBy("id", "desc")->paginate(10);
        
        return view("admin.user_list", [
			"user_list" => $user_list
		]);
    }
}
