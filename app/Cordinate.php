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
    
    /**
     * この投稿が所有するコメント。（ Commentモデルとの関係を定義）
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    /**
     * この投稿が所有するタグ。（ Tagモデルとの関係を定義）
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'cordinates_tags');
    }
    
    /**
     * この投稿をクリップしたユーザ。（ Userモデルとの関係を定義）
     */
    public function favorites_users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'cordinate_id', 'user_id')->withTimestamps();
    }
    
    /**
     * この投稿をいいね！したユーザ。（ Userモデルとの関係を定義）
     */
    public function nice_users()
    {
        return $this->belongsToMany(User::class, 'nice', 'cordinate_id', 'user_id')->withTimestamps();
    }
    
    /**
     * この投稿に関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount(['comments','favorites_users','nice_users']);
    }
    
}
