<?php

header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: *' );
header( 'Access-Control-Allow-Methods: *');

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

Route::resource('ingredient','IngredientController');
Route::resource('user', 'UserController');
Route::resource('product', 'ProductController');
Route::get('users/{user}/ingredients', 'UserController@showIngredients');
Route::get('users/{user}/products', 'UserController@showProducts');
Route::get('products/{product}/ingredients', 'ProductController@showIngredients');
Route::get('products/{barcode}/barcode', 'ProductController@getProduct');