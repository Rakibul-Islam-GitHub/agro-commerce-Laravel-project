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
    return view('welcome');
});

Route::get('/seller', 'sellerController@index')->name('seller.dashboard');
Route::get('/seller/additem', 'sellerController@additem')->name('seller.additem');
Route::get('/seller/manageitem', 'sellerController@manageitem')->name('seller.manageitem');
Route::get('/seller/manageitem/delete', 'sellerController@itemdelete');
Route::get('/seller/review', 'sellerController@review')->name('seller.review');
Route::get('/seller/order', 'sellerController@order')->name('seller.order');
Route::post('/seller/additem', 'sellerController@itemstore');