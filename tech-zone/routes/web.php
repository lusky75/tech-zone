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
    return redirect()->action('ProductController@catalogue');
});

Route::get('/search', function () {
    return redirect()->action('ProductController@catalogue');
});

Route::get('/profile', function () {
    return redirect()->action('ProductController@catalogue');
});

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');
Route::post('/admin', 'AdminController@add_product')->name('admin');
Route::post('/product', 'AdminController@update_quantity')->name('admin');
Route::get('/update/{admin}/{id}', 'AdminController@change_right')->name('admin');
Route::get('/delete/{id}', 'AdminController@delete')->name('admin');

Route::get('/pay/{total}', 'CartController@pay')->name('cart');
Route::get('/cart/{id}', 'CartController@index')->name('cart');
Route::get('/remove/{id}/{id_user}', 'CartController@remove')->name('cart');
Route::post('/change', 'CartController@update_quantity')->name('cart');

Route::get('/profile/{id}', 'ProfileController@index')->name('profile');
Route::get('/update_profile/{id}', 'ProfileController@page')->name('update_profile');
Route::post('/profile', 'ProfileController@update_profile')->name('profile');

Route::post('/search', 'ProductController@search')->name('search');
Route::get('/catalogue', 'ProductController@catalogue')->name('catalogue');
Route::get('/update/{quantity}/{amount}/{id_user}/{id_product}', 'ProductController@buy')->name('catalogue');
Route::post('/cata', 'ProductController@buy_product')->name('product');
Route::get('/product/{id}', 'ProductController@product')->name('catalogue');
Route::get('/catalogue/{category}', 'ProductController@display')->name('catalogue');
Route::get('/product', 'ProductController@catalogue')->name('catalogue');

Route::post('/review', 'ProductController@review')->name('review');
Route::get('/update/{id}', 'ProductController@delete_comment')->name('review');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/orders/{id}', 'OrdersController@display_orders')->name('orders');
Route::get('/page_orders/{id}', 'OrdersController@show_orders')->name('orders');

Route::post('/ajax', 'CartController@SaveData')->name('ajax');
