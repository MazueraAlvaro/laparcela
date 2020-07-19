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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
});

Route::apiResource("payment","PaymentController");

Route::apiResource("category", "CategoryController");
Route::get("/category/{id}/products", "CategoryController@products")->name("category.products");

Route::apiResource("product", "ProductController");
Route::get("product/search/{term}", "ProductController@search")->name("product.search");

Route::post("order/fromCart", "OrderController@storeFromCart");
Route::post("order/close", "OrderController@close");
Route::apiResource("order", "OrderController")->except(["destroy"]);

Route::apiResource("orderProduct", "OrderProductController")->except(['index']);
//
Route::get("shoppingCart", "ShoppingCartController@cart")->name("shoppingCart.cart");
Route::apiResource("shoppingCart.products", "ShoppingCartController");

