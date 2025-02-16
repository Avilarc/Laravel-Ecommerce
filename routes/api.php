<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::post('products/{product}/images', [ProductImageController::class, 'store']);
Route::delete('products/{product}/images/{image}', [ProductImageController::class, 'destroy']);