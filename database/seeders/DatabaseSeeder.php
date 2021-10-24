<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Product::create(['title' => 'Jihyo', 'content' => 'my idol', 'price' => rand(500,1000), 'quantity' => 10]);
        Product::create(['title' => 'Momo', 'content' => 'my idol', 'price' => rand(500,1000), 'quantity' => 10]);
        Product::create(['title' => 'Sana', 'content' => 'my idol', 'price' => rand(500,1000), 'quantity' => 10]);
        $this->call(ProductSeeder::class);
        $this->command->info('產生固定資料');
    }
}
