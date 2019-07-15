<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('user', function (Request $request) {
    return $request->user();
});

Route::get('suppliers', 'SupplierController@index');
Route::get('suppliers/{supplier_id}', 'SupplierController@show');
Route::any('suppliers', 'SupplierController@store');
Route::put('suppliers', 'SupplierController@update');
Route::delete('suppliers/{supplier_id}', 'SupplierController@destroy');

Route::get('orders', 'OrderController@index');
Route::get('orders/{id}', 'OrderController@show');
Route::post('orders', 'OrderController@store');
Route::put('orders', 'OrderController@store');
Route::delete('orders/{orders_id}', 'OrderController@destroy');

Route::get('products', 'ProductController@index');
Route::get('products/{id}', 'ProductController@show');
Route::post('products', 'ProductController@store');
Route::put('products', 'ProductController@store');
Route::delete('products/{product_id}', 'ProductController@destroy');