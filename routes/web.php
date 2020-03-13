<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('store');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products', 'ProductController@index')->name('product');

Route::get('/store', 'storeController@store')->name('store');
Route::delete('/product/{product}', 'ProductController@destroy')->name('product.remove');
Route::put('/product/{product}', 'ProductController@update')->name('product.update');

Route::get('/Cart/{product}', 'ProductController@addToCart')->name('Cart.add');

Route::get('/Shopping-Cart', 'ProductController@ShowCart')->name('cart.show');

Route::get('/orders', 'orderController@index')->name('order.index');
Route::get('/checkOut/{amount}', 'ProductController@CheckOut')->name('Cart.CheckOut')->middleware('auth');
Route::POST('/charge', 'ProductController@Charge')->name('Cart.Charge')->middleware('auth');




Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
