<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebbhController;
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

Route::get('/', 'WebbhController@index')->name('home');
Route::get('/details/{id}/{slug}.html', 'WebbhController@getDetails')->name('getDetails');
Route::post('/details/{id}/{slug}.html', 'WebbhController@postComment');
Route::get('/category/{id}/{slug}.html','WebbhController@getCategory')->name('getCategory');
Route::get('/search','WebbhController@getSearch')->name('search');
Route::get('/complete','WebbhController@getComplete')->name('complete');

Route::group(['prefix'=>'cart'],function(){
	Route::get('add/{id}','CartController@getAddCart')->name('getAdd');
	Route::get('show','CartController@getShowCart')->name('getShow');
	Route::post('show','CartController@postComplete');
	Route::get('delete/{id}','CartController@getDeleteCart')->name('deleteProduct');
	Route::get('update','CartController@getUpdateCart')->name('updateCart');

});