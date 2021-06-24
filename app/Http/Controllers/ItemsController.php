<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 以下追加
use App\User;
use App\Cordinate;
use App\Item;
use App\Category;
use App\Subcategory;
use App\Size;
use App\Brand;

class ItemsController extends Controller
{
    public function create($id)
    {
        // idの値で投稿を検索して取得
        $cordinate = Cordinate::findOrFail($id);
        
        $categoryList = Category::pluck('category', 'id');
        $subCategoryList = SubCategory::pluck('subcategory', 'id');
        $sizeList = Size::pluck('size', 'id');
        
        $addItems = Cordinate::findOrFail($id)->items()->get();
        foreach($addItems as $additem) {
            $additem->category_id = Category::where('id',$additem->category_id)->value('category');
            $additem->subcategory_id = Subcategory::where('id',$additem->subcategory_id)->value('subcategory');
            $additem->brand_id =Brand::where('id',$additem->brand_id)->value('brand');
            $additem->size_id = Size::where('id',$additem->size_id)->value('size');
        }
        
        return view('items.create', compact('cordinate','categoryList', 'subCategoryList', 'sizeList', 'addItems'));
    }
    
    public function store(Request $request,$id)
    {
        //アップデート時のバリデーション
        $request->validate([
            'cordinate_id' => ['required'],
            'category_id' => ['required'],
            'subcategory_id' => ['required'],
            'size_id' => ['required'],
            'brand_id' => ['required'],
        ]);
         
        // idの値で投稿を検索して取得
        $cordinate = Cordinate::findOrFail($id);
        
        $brandname = $request->brand;
        // すでに$brandnameがあれば取得し、なければ新規作成する。
        $record = Brand::firstOrCreate(['brand' => $brandname]);
        
        $item = $cordinate->items()->create([
            'cordinate_id' => $cordinate->id,
            'category_id' => $request->category_id,
            'subcategory_id' => 1,
            'size_id' => $request->size_id,
            'brand_id'=> $record->id,
        ]);
        
        // 投稿作成画面へ戻る
        return redirect()->route('items.create', $id);
    }
    
    public function destroy($id,$item)
    {
        // idの値で投稿を検索して取得
        $cordinate = Cordinate::findOrFail($id);
        
        // idの値でアイテムを検索して取得
        $item = Item::findOrFail($item);
        
        // 認証済みユーザ（閲覧者）がその投稿の投稿者である場合は、アイテムを削除
        if (\Auth::id() === $cordinate->user_id) {
            $item->delete();
        }
        // 前のURLへリダイレクトさせる
        return redirect()->route('items.create', $cordinate);
    }
    /**
     * ajaxリクエストを受け取り、サブカテゴリを返す
     */
    public function fetch(Request $request) {
        $cateVal = $request['category_val'];
        $subCategory = Subcategory::where('category_id', $cateVal)->get();
        return $subCategory;
    }
}
