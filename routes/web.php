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
Route::get('/seller/manageitem/edit/{id}', 'sellerController@edititem')->name('seller.edititem');
Route::post('/seller/manageitem/edit/{id}', 'sellerController@updateitem');
Route::post('/seller/manageitem/soldout', 'sellerController@soldout');
Route::put('/seller/manageitem/stockavailable', 'sellerController@stockavailable');
Route::get('/seller/manageitem/delete', 'sellerController@itemdelete');
Route::get('/seller/review', 'sellerController@review')->name('seller.review');
Route::post('/seller/review/delete', 'sellerController@reviewdelete');
Route::get('/seller/order', 'sellerController@order')->name('seller.order');
Route::put('/seller/order/approveorder', 'sellerController@approveorder')->name('seller.order');
Route::post('/seller/additem', 'sellerController@itemstore');
Route::get('/seller/profile', 'sellerController@profile')->name('seller.profile');
Route::post('/seller/profile', 'sellerController@profileupdate')->name('seller.profileupdate');
Route::get('/seller/message', 'sellerController@message')->name('seller.message');
Route::post('/seller/message', 'sellerController@messagestore');
Route::post('/seller/messageshow', 'sellerController@messageshow');
Route::get('/seller/category', 'sellerController@guzzlereq');
