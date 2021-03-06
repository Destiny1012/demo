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

Route::get('/', 'UserController@index')->name('home');
Route::get('/login', 'PageController@login')->name('login');
Route::get('/register', 'PageController@register')->name('register');

Route::post('/login', 'UserController@login')->name('login');
Route::post('/logout', 'UserController@logout')->name('logout');

Route::resource('/goods', 'GoodsController');
Route::resource('/catalog', 'CatalogController');
