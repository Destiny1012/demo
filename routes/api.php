<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) { return $request->user(); });

Route::post('/register', 'Api\UserController@register');
Route::post('/login', 'Api\UserController@login');
Route::post('/logout', 'Api\UserController@logout');
Route::post('/user/{user}', 'Api\UserController@show')->middleware('auth:api');
Route::post('/user/update/{user}', 'Api\UserController@update');
Route::post('/catalog', 'Api\CatalogController@index');
Route::post('/goods', 'Api\GoodsController@index');
Route::post('/order', 'Api\OrderController@index');
Route::post('/order/{user}', 'Api\OrderController@store');
