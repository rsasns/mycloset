<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['category'];
    
    /**
     * このカテゴリが所有するアイテム。（Itemモデルとの関係を定義）
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
    /**
     * このカテゴリが所有するサブカテゴリ。（ Subcategoryモデルとの関係を定義）
     */
    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }
}
