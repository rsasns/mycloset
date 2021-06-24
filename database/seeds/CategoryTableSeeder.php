<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            ['category' => 'レディース'],
            ['category' => 'メンズ'],
            ['category' => 'キッズ/ベビー/マタニティ'],
            ['category' => 'その他']
        ];
        DB::table('category')->insert($category);
    }
}
