<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource("category", "CategoryController")->names([
    'index' => 'category.index',
    'store' => 'category.store',
    'update' => 'category.update',
]);
Route::get("/category/{id}/products", "CategoryController@products")->name("category.products");

Route::apiResource("product", "ProductController")->names([
    'index' => 'product.index',
    'store' => 'product.store',
    'update' => 'product.update',
]);
Route::get("product/search/{term}", "ProductController@search")->name("product.search");
