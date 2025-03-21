<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Category::factory(3)->create()->each(function($category){
            Product::factory(10)->create(['category_id' => $category->id]);
        });

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call([
        //     //first category, then products because it has a foreign key
        //     CategoryTableSeeder::class,
        //     ProductTableSeeder::class
        // ]);
    }
}
