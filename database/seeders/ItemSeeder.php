<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('items')->insert([
            [
                'name' => 'カメラ',
                'memo' => '写真撮影',
                'price' => 2000,
                'is_selling' => true,
            ],
            [
                'name' => '本棚',
                'memo' => '本を置く',
                'price' => 2999,
                'is_selling' => true,
            ],
            [
                'name' => '本',
                'memo' => '雑誌等',
                'price' => 1200,
                'is_selling' => true,
            ],
            [
                'name' => 'テーブル',
                'memo' => '食卓',
                'price' => 5999,
                'is_selling' => true,
            ],
            [
                'name' => '冷蔵庫',
                'memo' => '食材保存',
                'price' => 13000,
                'is_selling' => true,
            ],
            [
                'name' => 'キッチン道具セット',
                'memo' => 'フライパンなど料理道具',
                'price' => 2999,
                'is_selling' => true,
            ],
        ]);
    }
}
