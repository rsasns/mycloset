<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'user_id'];
    
    /**
     * このコメントを所有するユーザ。（ Cordinateモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * このコメントを所有するコーディネート。（ Cordinateモデルとの関係を定義）
     */
    public function cordinate()
    {
        return $this->belongsTo(Cordinate::class);
    }
}
