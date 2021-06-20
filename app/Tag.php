<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag'];
    
    /**
     * このタグが所有する投稿。（ Cordinateモデルとの関係を定義）
     */
    public function cordinates()
    {
        return $this->belongsToMany(Cordinate::class,'cordinates_tags');
    }
    
    /**
     * この投稿に関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount(['cordinates']);
    }
}
