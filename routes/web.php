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

Auth::routes();
Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'todo'], function(){
	Route::post('/store', 'TodoController@store')->name('store_todo');
	Route::put('/update/{todo}', 'TodoController@update')->name('update_todo');
});
Route::get('/home', 'TodoController@create')->name('all_todos');
