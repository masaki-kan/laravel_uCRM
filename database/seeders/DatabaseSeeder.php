<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            ItemSeeder::class
        ]);

        $items = Item::all();
        \App\Models\Customer::factory(1000)->create(); //CustomerFactoryで書いた内容を１０００件作成する
        Purchase::factory(10000)->create()->each(function (Purchase $purchase) use ($items) { //eachは一件ずつ処理
            $purchase->items()->attach(
                //attach()を使うと中間テーブルにも値をセットできる
                // 1~3個のitemをpurchaseにランダムに紐づけ
                $items->random(rand(1, 3))->pluck('id')->toArray(),
                ['quantity' => rand(1, 5)]
            );
        });



        /**
         * item_purchaseのpurchase_idはPurchaseが100件を１件ずつ作成と同時に中間テーブルも作成するので
         * attach()によって Purchaseのidが自動でpurchase_idにセットされる
         * 
         */
    }
}
