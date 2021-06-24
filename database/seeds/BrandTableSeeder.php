<?php

use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = [
            ['size' => 'FREE/ONESIZE'],
            ['size' => '~XS'],
            ['size' => 'S'],
            ['size' => 'M'],
            ['size' => 'L'],
            ['size' => 'XL~'],
            ['size' => 'その他'],
        ];
        DB::table('brand')->insert($brand);
    }
}
