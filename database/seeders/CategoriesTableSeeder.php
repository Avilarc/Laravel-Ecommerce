<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Smartphones',
            'Laptops',
            'Tablets',
            'Smartwatches',
            'Headphones',
            'Cameras',
            'Gaming Consoles',
            'Televisions',
            'Home Appliances',
            'Accessories',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}