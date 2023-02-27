<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id' => Str::uuid(),
            'sku' => Str::random(10),
            'name' => Str::random(10),
            'price' => 1000,
            'stock' => 10,
            'category_id' => Str::uuid(),
        ]);
    }
}
