<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['cordinate_id','category_id','subcategory_id','brand_id','size_id'];
    
    /**
     * このアイテムに紐づく投稿。（Cordinateモデルとの関係を定義）
     */
    public function cordinate()
    {
        return $this->belongsTo(Cordinate::class);
    }
    
    /**
     * このアイテムに紐づくカテゴリ。（Categoryモデルとの関係を定義）
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    /**
     * このアイテムに紐づくサブカテゴリ。（Subategoryモデルとの関係を定義）
     */
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    
    /**
     * このアイテムに紐づくブランド。（Brandモデルとの関係を定義）
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    
    /**
     * このアイテムに紐づくサイズ。（Sizeモデルとの関係を定義）
     */
    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
