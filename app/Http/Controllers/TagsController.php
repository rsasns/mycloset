<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagsController extends Controller　//使ってません！！！
{
    public function store(Request $request)
    {
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
        
        // 投稿にタグを紐づけ
        $cordinate->tags()->attach($tags_id);
        
        // 作成した画面に遷移する
        return redirect()->route('cordinates.create');
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
