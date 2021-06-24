<?php

use Illuminate\Database\Seeder;

class SizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $size = [
            ['size' => 'FREE/ONESIZE'],
            ['size' => '~XS'],
            ['size' => 'S'],
            ['size' => 'M'],
            ['size' => 'L'],
            ['size' => 'XL~'],
            ['size' => 'その他'],
        ];
        DB::table('size')->insert($size);
    }
}
