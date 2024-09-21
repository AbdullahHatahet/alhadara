<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            "name"=> "Laptops",
            "image"=> "images/1725726798.png",
        ]);

        Category::create([
            "name"=> "Mobiles",
            "image"=> "images/1725726798.png",
        ]);

        Category::create([
            "name"=> "Watches",
            "image"=> "images/1725726798.png",
        ]);
    }
}
