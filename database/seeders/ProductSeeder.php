<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::upsert(
            [
                ['id' => 6 ,'title' => 'forever_Jihyo', 'content' => 'my idol', 'price' => rand(500,1000), 'quantity' => 10],
                ['id' => 7 ,'title' => 'forever_Momo', 'content' => 'my idol', 'price' => rand(500,1000), 'quantity' => 10],
            ],['id'],['price', 'quantity']
        );
    }
}
