<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','HomeController@index')->name('home');

Route::get('/drugs','DrugController@index');
Route::get('/drug/{id}','DrugController@show')->name('drug.show');

Route::get('/shops','ShopController@index')->name('shop.index');
Route::get('/map','ShopController@map')->name('shop.map');

Route::post('/planning', 'PlanningController@store')->name('planning.store');

Route::post('/planning/feature/add', 'PlanningController@addFeature');

Route::get('/test', function () {
   
});



Auth::routes();


