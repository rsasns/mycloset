<?php

use Illuminate\Database\Seeder;

class SubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategory = [
            ['category_id' => 1, 'subcategory' => 'トップス'],
            ['category_id' => 1, 'subcategory' => 'ジャケット/アウター'],
            ['category_id' => 1, 'subcategory' => 'ワンピース'],
            ['category_id' => 1, 'subcategory' => 'パンツ'],
            ['category_id' => 1, 'subcategory' => 'スカート'],
            ['category_id' => 1, 'subcategory' => 'バッグ'],
            ['category_id' => 1, 'subcategory' => 'ファッション小物'],
            ['category_id' => 1, 'subcategory' => '靴/シューズ'],
            ['category_id' => 1, 'subcategory' => 'アクセサリー'],
            ['category_id' => 1, 'subcategory' => 'ヘアアクセサリー'],
            ['category_id' => 1, 'subcategory' => '水着/浴衣'],
            ['category_id' => 1, 'subcategory' => 'フォーマル/ドレス'],
            ['category_id' => 1, 'subcategory' => '帽子'],
            ['category_id' => 1, 'subcategory' => 'ルームウェア/パジャマ'],
            ['category_id' => 1, 'subcategory' => '下着/アンダーウェア'],
            ['category_id' => 1, 'subcategory' => 'レッグウェア'],
            ['category_id' => 1, 'subcategory' => 'ウィッグ/エクステ'],
            ['category_id' => 1, 'subcategory' => 'レディース/その他'],
            ['category_id' => 2, 'subcategory' => 'トップス'],
            ['category_id' => 2, 'subcategory' => 'ジャケット/アウター'],
            ['category_id' => 2, 'subcategory' => 'パンツ'],
            ['category_id' => 2, 'subcategory' => '靴/シューズ'],
            ['category_id' => 2, 'subcategory' => 'バッグ'],
            ['category_id' => 2, 'subcategory' => 'スーツ'],
            ['category_id' => 2, 'subcategory' => '帽子'],
            ['category_id' => 2, 'subcategory' => 'アクセサリー'],
            ['category_id' => 2, 'subcategory' => 'ファッション小物'],
            ['category_id' => 2, 'subcategory' => '時計'],
            ['category_id' => 2, 'subcategory' => '水着/浴衣'],
            ['category_id' => 2, 'subcategory' => 'レッグウェア'],
            ['category_id' => 2, 'subcategory' => 'アンダーウェア'],
            ['category_id' => 2, 'subcategory' => 'メンズ/その他'],
            ['category_id' => 3, 'subcategory' => 'キッズ服'],
            ['category_id' => 3, 'subcategory' => 'ベビー服'],
            ['category_id' => 3, 'subcategory' => 'キッズ靴/シューズ'],
            ['category_id' => 3, 'subcategory' => 'ベビー靴/シューズ'],
            ['category_id' => 3, 'subcategory' => 'マタニティ'],
            ['category_id' => 3, 'subcategory' => 'キッズ/ベビー/マタニティ/その他'],
        ];
        
        DB::table('subcategory')->insert($subcategory);
    }
}
