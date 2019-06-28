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

Route::get('/sync-small-appliance', 'scrappingController@asyncSmallAppliance')->name('sync-small-appliance');
Route::get('/sync-diswashers', 'scrappingController@asyncDiswashers')->name('sync-diswashers');
Route::get('/delete-all-products', 'scrappingController@deleteAll')->name('delete-all');

Auth::routes();

Route::get('/dashboard', 'HomeController@dasboard')->name('dashboard');
Route::get('/', 'ProductController@index')->name('index');
Route::get('/product/{id}', 'ProductController@product')->name('product');


//categorys
Route::get('/category/dishwashers', 'ProductController@dishwashers')->name('dishwashers');
Route::get('/category/small-appliance', 'ProductController@small_appliance')->name('small-appliance');

Route::get('test/{id}', 'ProductController@test');
