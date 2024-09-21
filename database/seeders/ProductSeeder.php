<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "category_id"=> 1,
            "name"=> "Dell inspiron",
            "description"=> "details are ...... ",
            "image"=> "images/1725726798.png",
            "price"=> "1000",
        ]);
        Product::create([
            "category_id"=> 1,
            "name"=> "Acer",
            "description"=> "details are ...... ",
            "image"=> "images/1725726798.png",
            "price"=> "1000",
        ]);
        Product::create([
            "category_id"=> 1,
            "name"=> "HP",
            "description"=> "details are ...... ",
            "image"=> "images/1725726798.png",
            "price"=> "1000",
        ]);

        Product::create([
            "category_id"=> 2,
            "name"=> "HP",
            "description"=> "details are ...... ",
            "image"=> "images/1725726798.png",
            "price"=> "1000",
        ]);
    }
}
