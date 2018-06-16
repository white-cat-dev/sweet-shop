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


Route::get('/', 'WelcomeController@index');

Route::get('/cakes', 'CakeController@index');
Route::get('/cake/create', 'CakeController@create');
Route::post('/cake', 'CakeController@save');
Route::get('/cake/{id}/edit', 'CakeController@edit');
Route::put('/cake/{id}', 'CakeController@update');
Route::delete('/cake/{id}', 'CakeController@delete');

Route::get('/ingredients', 'IngredientController@index');
Route::get('/ingredients/all', 'IngredientController@all');
Route::post('/ingredient', 'IngredientController@save');
Route::delete('/ingredient/{id}', 'IngredientController@delete');
Route::put('/ingredients', 'IngredientController@updateAll');

Route::get('/orders', 'OrderController@index');
Route::get('/orders/status={status}', 'OrderController@findStatus');
Route::put('/order/{id}', 'OrderController@update');
Route::delete('/order/{id}', 'OrderController@delete');

Route::get('/reviews', 'ReviewController@index');
Route::delete('/review/{id}', 'ReviewController@delete');

Auth::routes();