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

Route::get('/planning/{id}', 'PlanningController@show')->name('planning.show');
Route::post('/planning', 'PlanningController@store')->name('planning.store');
Route::post('/planning/feature/add', 'PlanningController@addFeature');


Route::get('/drugs','DrugController@index');
Route::get('/drug/{id}','DrugController@show')->name('drug.show');

Route::get('/shops','HomeController@index')->name('shop.index');
Route::get('/shop/{id}','ShopController@show')->name('shop.show');



Route::get('/test', function () {
   
});



Auth::routes();


