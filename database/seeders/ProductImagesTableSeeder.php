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
            'storage/images/iphone15pro.jpg',
            'storage/images/galaxys23.jpg',
            'storage/images/macbookairm2.jpg',
            'storage/images/dellxps13.jpg',
            'storage/images/ipadpro129.jpg',
            'storage/images/applewatch8.jpg',
            'storage/images/sonywh1000xm5.jpg',
            'storage/images/canoneosr5.jpg',
            'storage/images/ps5.jpg',
            'storage/images/lgoledc2.jpg',
        ];

        foreach ($products as $product) {
            ProductImage::create([
                'product_id' => $product->id,
                'url' => $images[array_rand($images)],
            ]);
        }
    }
}