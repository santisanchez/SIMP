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
        /*Auth Controller*/
        Route::post('getUser', 'Api\AuthController@getUser');
        /*Store Controller */
        Route::post('createStore', 'Api\StoreController@CreateStore');
        Route::post('storeProducts','Api\StoreController@GetProducts');
        Route::post('sellProducts','Api\StoreController@SellProducts');
        /*Product Controller */
        Route::post('createProduct','Api\ProductController@CreateProduct');
    });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
