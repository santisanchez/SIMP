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

Route::prefix('v1')->group(function(){
        Route::post('/login', 'Api\AuthController@login');
        Route::post('/register', 'Api\AuthController@register');
        Route::get('/users','Api\AuthController@users');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('getUser', 'Api\AuthController@getUser');
        Route::post('createStore', 'Api\StoreController@CreateStore');
        Route::post('createProduct','Api\ProductController@CreateProduct');
        Route::post('storeProducts','Api\StoreController@GetProducts');
    });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
