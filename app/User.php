<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * このユーザが所有する投稿。（ Cordinateモデルとの関係を定義）
     */
    public function cordinates()
    {
        return $this->hasMany(Cordinate::class);
    }
    
    /**
     * このユーザがフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    /**
     * このユーザをフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }

    /**
     * このユーザがクリップした投稿。（ Coridnateモデルとの関係を定義）
     */
    public function favorites()
    {
        return $this->belongsToMany(Cordinate::class, 'favorites', 'user_id', 'cordinate_id')->withTimestamps();
    }
    
    /**
     * このユーザがいいね！した投稿。（ Coridnateモデルとの関係を定義）
     */
    public function nice()
    {
        return $this->belongsToMany(Cordinate::class, 'nice', 'user_id', 'cordinate_id')->withTimestamps();
    }
    
    /**
     * このユーザがコメントした投稿。（ Commentモデルとの関係を定義）
     */
    public function comments()
    {
        return $this->hasmany(Comment::class);
    }
    
    /**
     * このユーザに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount(['cordinates', 'followings', 'followers', 'favorites', 'nice', 'comments']);
    }
    
     /**
     * $userIdで指定されたユーザをフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function follow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 対象が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist || $its_me) {
            // すでにフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }

    /**
     * $userIdで指定されたユーザをアンフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function unfollow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 対象が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            // すでにフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }

    /**
     * 指定された $userIdのユーザをこのユーザがフォロー中であるか調べる。フォロー中ならtrueを返す。
     *
     * @param  int  $userId
     * @return bool
     */
    public function is_following($userId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->followings()->where('follow_id', $userId)->exists();
    }

    /**
     * このユーザとフォロー中ユーザの投稿に絞り込む。
     */
    public function feed_cordinates()
    {
        // このユーザがフォロー中のユーザのidを取得して配列にする
        $userIds = $this->followings()->pluck('users.id')->toArray();
        // このユーザのidもその配列に追加
        $userIds[] = $this->id;
        // それらのユーザが所有する投稿に絞り込む
        return Cordinate::whereIn('user_id', $userIds);
    }
    
    /**
     * $cordinateIdで指定された投稿をクリップする。
     *
     * @param  int  $cordinateId
     * @return bool
     */
    public function favorite($cordinateId)
    {
        // すでにクリップしているかの確認
        $exist = $this->is_favorite($cordinateId);

        if ($exist) {
            // すでにクリップしていれば何もしない
            return false;
        } else {
            // 違うならクリップする
            $this->favorites()->attach($cordinateId);
            return true;
        }
    }

    /**
     * $cordinateIdで指定された投稿のクリップを外す。
     *
     * @param  int  $userId
     * @return bool
     */
    public function unfavorite($cordinateId)
    {
        // すでにクリップしているかの確認
        $exist = $this->is_favorite($cordinateId);

        if ($exist ) {
            // すでにクリップしていれば外す
            $this->favorites()->detach($cordinateId);
            return true;
        } else { //違うならなにもしない
            return false;
        }
    }

    /**
     * 指定された $coridnateIdの投稿をこのユーザがクリップしているか調べる。クリップしているならtrueを返す。
     *
     * @param  int  $cordinateId
     * @return bool
     */
    public function is_favorite($cordinateId)
    {
        // このユーザがクリップしている投稿の中に $coridnateIdのものが存在するか
        return $this->favorites()->where('cordinate_id', $cordinateId)->exists();
    }
    
    /**
     * $cordinateIdで指定された投稿をいいね！する。
     *
     * @param  int  $cordinateId
     * @return bool
     */
    public function onnice($cordinateId)
    {
        // すでにいいねしているかの確認
        $exist = $this->is_nice($cordinateId);

        if ($exist) {
            // すでにいいねしていれば何もしない
            return false;
        } else {
            // 違うならいいねする
            $this->nice()->attach($cordinateId);
            return true;
        }
    }

    /**
     * $cordinateIdで指定された投稿のいいね！を外す。
     *
     * @param  int  $cordinateId
     * @return bool
     */
    public function unnice($cordinateId)
    {
        // すでにいいねしているかの確認
        $exist = $this->is_nice($cordinateId);

        if ($exist ) {
            // すでにいいねしていれば外す
            $this->nice()->detach($cordinateId);
            return true;
        } else { //違うならなにもしない
            return false;
        }
    }

    /**
     * 指定された $coridnateIdの投稿をこのユーザがいいねしているか調べる。いいねしているならtrueを返す。
     *
     * @param  int  $cordinateId
     * @return bool
     */
    public function is_nice($cordinateId)
    {
        // このユーザがいいねしている投稿の中に $coridnateIdのものが存在するか
        return $this->nice()->where('cordinate_id', $cordinateId)->exists();
    }
}