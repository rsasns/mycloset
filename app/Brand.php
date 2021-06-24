<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $fillable = ['brand'];
    
    /**
     * このブランドが所有するアイテム。（Itemモデルとの関係を定義）
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
}
