<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cordinate extends Model
{
    protected $fillable = ['image','text'];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
