<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get_category', 'App\Http\Controllers\Category\CategoryController@getCategory');
Route::get('category_id/{id}', 'App\Http\Controllers\Category\CategoryController@getCategory_id');


Route::post('post_create_market', 'App\Http\Controllers\Category\CategoryController@createMarket');
Route::post('post_market_edit_form', 'App\Http\Controllers\Category\CategoryController@editMarket');


