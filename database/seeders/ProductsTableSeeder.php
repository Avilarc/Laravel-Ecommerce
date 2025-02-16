<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        $products = [
            ['name' => 'iPhone 15 Pro', 'price' => 999.99, 'stock' => 50],
            ['name' => 'Samsung Galaxy S23', 'price' => 899.99, 'stock' => 60],
            ['name' => 'MacBook Air M2', 'price' => 1299.99, 'stock' => 30],
            ['name' => 'Dell XPS 13', 'price' => 1199.99, 'stock' => 40],
            ['name' => 'iPad Pro 12.9', 'price' => 1099.99, 'stock' => 25],
            ['name' => 'Apple Watch Series 8', 'price' => 399.99, 'stock' => 100],
            ['name' => 'Sony WH-1000XM5', 'price' => 349.99, 'stock' => 80],
            ['name' => 'Canon EOS R5', 'price' => 3799.99, 'stock' => 15],
            ['name' => 'PlayStation 5', 'price' => 499.99, 'stock' => 20],
            ['name' => 'LG OLED C2', 'price' => 1999.99, 'stock' => 10],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'active' => true,
                'category_id' => $categories->random()->id,
            ]);
        }
    }
}
