<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        foreach (range(1, 50) as $i) {

            $category_id = rand(1,8);
            $actual_price = rand(100, 10000);
            $discount_factor = (10 / 100) * $actual_price;
            $discount_price = $actual_price - $discount_factor;
            $price = $discount_price;


            DB::table('products')->insert([
                'title' => 'Product ' . $category_id,
                'imagePath' => 'https://www.komplett.no/img/p/800/c3e07913-3f53-4ef7-3879-1bba994c2209.jpg',
                'description' => 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the',
                'category_id' => $category_id,
                'original_price' => $actual_price,
                'discount_price' => $discount_price,
                'price' => $price,
                'in_stock' => rand(1,90),
                'status' => 1,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
