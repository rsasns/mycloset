<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'size';
    protected $fillable = ['size'];
    
    /**
     * このサイズが所有するアイテム。（Itemモデルとの関係を定義）
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
}
