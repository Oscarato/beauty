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

Route::get('/orders', 'ProductController@order');

Route::post('/add_order', 'ProductController@add_order');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/services', 'ServicesController@services')->name('services');

Route::post('/add_service', 'ServicesController@add_service');

Route::post('/update_service', 'ServicesController@update_service');



