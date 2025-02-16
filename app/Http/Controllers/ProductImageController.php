<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'url' => 'required|string',
        ]);

        $image = $product->images()->create([
            'url' => $request->url,
        ]);

        return response()->json(['message' => 'Imagen añadida correctamente', 'image' => $image], 201);
    }

    public function destroy(Product $product, ProductImage $image)
    {
        if ($image->product_id !== $product->id) {
            return response()->json(['error' => 'La imagen no pertenece al producto especificado'], 400);
        }

        $image->delete();
        return response()->json(['message' => 'Imagen eliminada correctamente']);
    }
}
