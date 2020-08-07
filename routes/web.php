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
Route::get('/', 'HomeController@index')->name('www.index');
Route::get('/home', 'HomeController@index')->name('index');
Route::get('/regulamin', 'HomeController@terms')->name('terms');
Route::get('/koszyk', 'HomeController@cart')->name('cart');
Route::get('/delete/{id}', 'HomeController@cartDelete')->name('delete');
Route::get('/dane', 'HomeController@userData')->name('data');
Route::post('/dziekujemy', 'HomeController@saveOrder')->name('save');
Route::get('/create_pdf/{order}', 'HomeController@createPDF')->name('create_pdf');


Route::namespace('Ajax')->name('ajax.')->prefix('ajax')->group(function () {
    Route::post('/add_product', 'AjaxController@addProduct')->name('add_product');
    Route::post('/get_price', 'AjaxController@getPrice')->name('get_price');
    Route::post('/update_amount', 'AjaxController@updateAmount')->name('update_amount');
    Route::post('/update_days', 'AjaxController@updateDays')->name('update_days');
    Route::post('/update_date', 'AjaxController@updateDate')->name('update_date');
    Route::post('/update_delivery', 'AjaxController@updateDelivery')->name('update_delivery');
});

Route::namespace('User')->name('user.')->prefix('uzytkownik')->group(function () {
    Route::get('/zamowienia', 'UserController@orders')->name('orders');
    Route::get('/szczegoly/{order}', 'UserController@details')->name('details');
});

Route::namespace('Admin')->name('admin.')->prefix('administracja')->group(function () {

    Route::get('/', 'OrderController@index')->name('index');

    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('/edit/{product}', 'ProductController@edit')->name('edit');
        Route::get('/edit_additional/{product}', 'ProductController@editAdditional')->name('edit_additional');
        Route::get('/create_additional', 'ProductController@createAdditional')->name('create_additional');
        Route::get('/create', 'ProductController@create')->name('create');
        Route::post('/store', 'ProductController@store')->name('store');
        Route::post('/update/{product}', 'ProductController@update')->name('update');
        Route::get('/destroy/{product}', 'ProductController@destroy')->name('destroy');
    });
    Route::prefix('delivery')->name('delivery.')->group(function () {
        Route::get('/', 'DeliveryController@index')->name('index');
        Route::get('/edit/{delivery}', 'DeliveryController@edit')->name('edit');
        Route::get('/create', 'DeliveryController@create')->name('create');
        Route::post('/store', 'DeliveryController@store')->name('store');
        Route::post('/update/{delivery}', 'DeliveryController@update')->name('update');
        Route::get('/destroy/{delivery}', 'DeliveryController@destroy')->name('destroy');
    });
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', 'OrderController@index')->name('index');
        Route::get('/details/{order}', 'OrderController@details')->name('details');
        Route::get('/edit/{order}', 'OrderController@edit')->name('edit');
        Route::post('/update/{order}', 'OrderController@update')->name('update');
        Route::get('/create', 'OrderController@create')->name('create');
        Route::post('/store', 'OrderController@store')->name('store');
        Route::get('/destroy/{order}', 'OrderController@destroy')->name('destroy');
        Route::get('/return/{orderProduct}', 'OrderController@changeStatusToReturn')->name('return');
        Route::get('/unavailable/{orderProduct}', 'OrderController@changeStatusToUnavailable')->name('unavailable');
    });
    Route::prefix('orderproduct')->name('orderproduct.')->group(function () {
        Route::get('/', 'OrderProductController@index')->name('index');
        Route::get('/details/{orderproduct}', 'OrderProductController@details')->name('details');
        Route::post('/update/{orderproduct}', 'OrderProductController@update')->name('update');
        Route::get('/create', 'OrderProductController@create')->name('create');
        Route::post('/store', 'OrderProductController@store')->name('store');
        Route::get('/destroy/{orderproduct}', 'OrderProductController@destroy')->name('destroy');
        Route::get('/extension/{orderProduct}', 'OrderProductController@extension')->name('extension');
        Route::post('/extension_save/{orderProduct}', 'OrderProductController@extension_save')->name('extension_save');
    });

    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/get_products', 'ApiController@getProducts')->name('get_products');
        Route::get('/get_statuses', 'ApiController@getOrderStatusList')->name('get_statuses');
    });
    Route::prefix('configuration')->name('configuration.')->group(function () {
        Route::get('/', 'ConfigurationController@index')->name('index');
        Route::post('/store', 'ConfigurationController@store')->name('store');
    });

    Route::get('login', 'LoginController@index')->name('login');

});
Auth::routes();
