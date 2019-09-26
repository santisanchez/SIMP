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
        Route::post('/login', 'api\AuthController@login');
        Route::post('/register', 'api\AuthController@register');
        Route::get('/users','api\AuthController@users');
    Route::group(['middleware' => 'auth:api'], function(){
        /*Auth Controller*/
        Route::post('getUser', 'api\AuthController@getUser');
        /*Store Controller */
        Route::post('createStore', 'api\StoreController@CreateStore');
        Route::post('storeProducts','api\StoreController@GetProducts');
        Route::post('sellProducts','api\StoreController@SellProducts');
        /*Product Controller */
        Route::post('createProduct','api\ProductController@CreateProduct');
    });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
