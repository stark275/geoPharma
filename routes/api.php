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

Route::group(['as' => 'api.', 'namespace' => 'Api'], function () {

    Route::get('user/planning/{id}', 'UserController@planning')->name('user.planning');

    Route::get('shops', 'ShopController@index')->name('shops.index');
    Route::get('shops/drug/{id}', 'ShopController@specificaldrug')->name('shops.specificaldrug');
});
