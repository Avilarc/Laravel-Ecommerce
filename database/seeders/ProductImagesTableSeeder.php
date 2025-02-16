<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImagesTableSeeder extends Seeder // Corregido: "ProductImagesTableSeeder"
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        $images = [
            '/images/iphone15pro.jpg',
            '/images/galaxys23.jpg',
            '/images/macbookairm2.jpg',
            '/images/dellxps13.jpg',
            '/images/ipadpro129.jpg',
            '/images/applewatch8.jpg',
            '/images/sonywh1000xm5.jpg',
            '/images/canoneosr5.jpg',
            '/images/ps5.jpg',
            '/images/lgoledc2.jpg',
        ];

        foreach ($products as $product) {
            ProductImage::create([
                'product_id' => $product->id,
                'url' => $images[array_rand($images)],
            ]);
        }
    }
}