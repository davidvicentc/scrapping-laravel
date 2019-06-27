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
