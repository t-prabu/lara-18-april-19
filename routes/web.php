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

Route::get('/', 'ProductController@index');

Route::post('/product/store', 'ProductController@store')->name('product.store');
Route::delete('/product/destroy/{id}', 'ProductController@destroy')->name('product.destroy');
Route::get('/product/destroy/{id}', 'ProductController@destroy')->name('product.destroy');
