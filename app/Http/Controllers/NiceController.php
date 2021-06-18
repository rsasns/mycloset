<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NiceController extends Controller
{
    /**
     * 投稿をいいねするアクション。
     *
     * @param  $id  投稿のid
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        // 認証済みユーザ（閲覧者）が、 idの投稿をいいねする
        \Auth::user()->onnice($id);
        // 前のURLへリダイレクトさせる
        return back();
    }

    /**
     * 投稿のいいねを外すアクション。
     *
     * @param  $id  投稿のid
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）が、 idの投稿のいいねを外す
        \Auth::user()->unnice($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
}
