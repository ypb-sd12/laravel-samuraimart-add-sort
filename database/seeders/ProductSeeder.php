<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use Product;
use App\Models\Product;
use Database\Factories\ProductFactory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ProductFactoryクラスで定義した内容に基づいてダミーデータを20県作成し、productsテーブルに追加する
        Product::factory()->count(20)->create();
    }
}
