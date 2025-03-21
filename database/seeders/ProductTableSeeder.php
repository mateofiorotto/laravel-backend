<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        //return a array with value of all the ids
        //1. obtain id of categorys
        $categoryIds = DB::table("category")->pluck("id")->toArray();

        if(empty($categoryIds)){
            $this->command->warn("No categories found. Please run the CategoryTableSeeder first.");
            return;
        }

        //create products randomly
        //2. generate products
        for ($i = 1; $i <= 50; $i++){
            $products[] = [
                "name" => $faker->word,
                "description" => $faker->sentence, //OLD: "description" => "Description " . $i,
                "price" => $faker->randomFloat(2, 10, 500), // 2 decimals, min 10, max 500 // OLD: "price" => rand(1, 100), // random price between 1 and 100
                "category_id" => $faker->randomElement($categoryIds), // OLD: "category_id" => $categoryIds[array_rand($categoryIds)],
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }

        DB::table("product")->insert($products);


        //for only execute this seedes --> php artisan db:seed --class=ProductTableSeeder
    }
}
