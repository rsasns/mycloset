<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//以下追加
use App\User;
use App\Comment;
use App\Cordinate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request, $id)
    {  
        //バリデーション
        $request->validate([
            'comment' => ['required', 'max:255']
        ]);
        $cordinate = Cordinate::findOrFail($id);

        // 投稿に紐づくコメントとして作成
        $cordinate->comments()->save(new Comment([
            'comment' => $request->comment,
            'user_id' => Auth::id()
        ]));
        
        // 前のURLへリダイレクトさせる
        return redirect()->route('cordinates.show', $id);
    }
    
    public function destroy($id)
    {
        // idの値で投稿に紐づくコメントを検索して取得
        $comment = Comment::findOrFail($id);
        // コメントに紐づく投稿を取得
        $cordinate = $comment->cordinate()->first();
        
        // 認証済みユーザ（閲覧者）がそのコメントの投稿者または紐づく投稿の投稿者である場合は、コメントを削除
        if (\Auth::id() === $comment->user_id || \Auth::id() === $cordinate->user_id) {
            $comment->delete();
        }
        // 前のURLへリダイレクトさせる
        return redirect()->route('cordinates.show', $cordinate->id);
    }
}
