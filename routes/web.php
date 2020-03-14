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

Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('index');
Route::get('/koszyk', 'HomeController@cart')->name('cart');
Route::get('/delete/{product}', 'HomeController@cartDelete')->name('delete');
Route::get('/dane', 'HomeController@userData')->name('data');
Route::post('/save_order', 'HomeController@saveOrder')->name('save');


Route::namespace('Ajax')->name('ajax.')->prefix('ajax')->group(function () {
    Route::post('/add_product', 'AjaxController@addProduct')->name('add_product');
    Route::post('/get_price', 'AjaxController@getPrice')->name('get_price');
});

Route::namespace('Admin')->name('admin.')->prefix('administracja')->group(function () {

    Route::get('/', 'DashboardController@index')->name('index');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', 'DashboardController@index')->name('index');
    });

    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('/edit/{product}', 'ProductController@edit')->name('edit');
        Route::post('/update/{product}', 'ProductController@update')->name('update');
        Route::get('/create', 'ProductController@create')->name('create');
        Route::post('/store', 'ProductController@store')->name('store');
        Route::get('/destroy/{product}', 'ProductController@destroy')->name('destroy');
    });
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', 'OrderController@index')->name('index');
        Route::get('/details/{order}', 'OrderController@details')->name('details');
        Route::post('/update/{order}', 'OrderController@update')->name('update');
        Route::get('/create', 'OrderController@create')->name('create');
        Route::post('/store', 'OrderController@store')->name('store');
        Route::get('/destroy/{order}', 'OrderController@destroy')->name('destroy');
        Route::get('/return/{orderProduct}', 'OrderController@changeStatusToReturn')->name('return');
        Route::get('/unavailable/{orderProduct}', 'OrderController@changeStatusToUnavailable')->name('unavailable');
    });

    Route::get('login', 'LoginController@index')->name('login');

});
Auth::routes();
