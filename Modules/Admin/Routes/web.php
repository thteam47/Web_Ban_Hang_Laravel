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

Route::prefix('admin')->group(function() {
	Route::get('/', 'AdminController@index');

	Route::group(['prefix' => 'category'],function(){
		Route::get('/','AdminCategoryController@index') -> name('admin.get.list.category');
		Route::get('/create','AdminCategoryController@create') -> name('admin.get.create.category');
		Route::post('/create','AdminCategoryController@store');
		Route::get('/update/{id}','AdminCategoryController@edit')->name('admin.get.edit.category');
		Route::post('/update/{id}','AdminCategoryController@update');
		Route::get('/detroy/{id}','AdminCategoryController@detroyX')->name('admin.get.detroy.category');
	});

	Route::group(['prefix' => 'product'],function(){
		Route::get('/','AdminProductController@index') -> name('admin.get.list.product');
		Route::get('/create','AdminProductController@create') -> name('admin.get.create.product');
		Route::post('/create','AdminProductController@store');
		Route::get('/update/{id}','AdminProductController@edit')->name('admin.get.edit.product');
		Route::post('/update/{id}','AdminProductController@update');
		Route::get('/detroy/{id}','AdminProductController@detroyX')->name('admin.get.detroy.product');
	});
	Route::group(['prefix' => 'advertisement'],function(){
		Route::get('/','AdminAdvertisementController@index') -> name('admin.get.list.adv');
		Route::get('/create','AdminAdvertisementController@create') -> name('admin.get.create.adv');
		Route::post('/create','AdminAdvertisementController@store');
		Route::get('/update/{id}','AdminAdvertisementController@edit')->name('admin.get.edit.adv');
		Route::post('/update/{id}','AdminAdvertisementController@update');
		Route::get('/detroy/{id}','AdminAdvertisementController@detroyX')->name('admin.get.detroy.adv');
	});
});
