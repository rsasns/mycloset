<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategory';
    protected $fillable = ['subcategory'];
    
    /**
     * このサブカテゴリが所有するアイテム。（Itemモデルとの関係を定義）
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
    /**
     * このサブカテゴリを所有するカテゴリ。（ Categoryモデルとの関係を定義）
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
