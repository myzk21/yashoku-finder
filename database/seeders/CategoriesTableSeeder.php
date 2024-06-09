<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'がっつり'],
            ['name' => 'こってり'],
            ['name' => 'あっさり'],
            ['name' => '酸っぱい'],
            ['name' => '塩辛い'],
            ['name' => '辛い'],
            ['name' => '甘い'],
            ['name' => '熱い'],
            ['name' => '冷たい'],
            ['name' => 'クリーミー'],
            ['name' => '苦い'],
            ['name' => 'かんたん調理'],

        ];
        foreach ($categories as $c) {
            DB::table('categories')->insert($c);
        }
    }
}
