<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|,'middleware'=>'Otp'
*/
//,'middleware'=>'CheckOtp' ,'middleware'=>'CheckLogedIn'
Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'login'],function(){
		Route::group(['middleware'=>'CheckLogedIn'],function(){
			Route::get('/','AdminLoginController@index')->name('login');
			Route::post('/','AdminLoginController@postLogin');
		});
		Route::group(['prefix'=>'otp','middleware'=>'CheckOtp'],function(){
			Route::get('/','OtpController@index')->middleware('can:three-auth');
			Route::post('/','OtpController@postOtp')->middleware('can:three-auth');
		});		
	});
});
//,'middleware'=>'Otp'
Route::group(['prefix'=>'admin','middleware'=>'Otp'],function(){
	Route::get('/', 'AdminController@index')->name('homeAdmin')->middleware('can:three-auth');
	Route::get('/logout', 'AdminController@getLogout')->name('logout')->middleware('can:three-auth');
	Route::group(['prefix' => 'category'],function(){
		Route::get('/','AdminCategoryController@index') -> name('admin.get.list.category')->middleware('can:two-auth');
		Route::get('/create','AdminCategoryController@create') -> name('admin.get.create.category')->middleware('can:two-auth');
		Route::post('/create','AdminCategoryController@store')->middleware('can:two-auth');
		Route::get('/update/{id}','AdminCategoryController@edit')->name('admin.get.edit.category')->middleware('can:two-auth');
		Route::post('/update/{id}','AdminCategoryController@update')->middleware('can:two-auth');
		Route::get('/detroy/{id}','AdminCategoryController@detroyX')->name('admin.get.detroy.category')->middleware('can:two-auth');
	});
	Route::group(['prefix' => 'product'],function(){
		Route::get('/','AdminProductController@index') -> name('admin.get.list.product')->middleware('can:three-auth');
		Route::get('/create','AdminProductController@create') -> name('admin.get.create.product')->middleware('can:three-auth');
		Route::post('/create','AdminProductController@store')->middleware('can:three-auth');
		Route::get('/update/{id}','AdminProductController@edit')->name('admin.get.edit.product')->middleware('can:three-auth');
		Route::post('/update/{id}','AdminProductController@update')->middleware('can:three-auth');
		Route::get('/detroy/{id}','AdminProductController@detroyX')->name('admin.get.detroy.product')->middleware('can:three-auth');
	});
	Route::group(['prefix' => 'advertisement'],function(){
		Route::get('/','AdminAdvertisementController@index') -> name('admin.get.list.adv')->middleware('can:two-auth');
		Route::get('/create','AdminAdvertisementController@create') -> name('admin.get.create.adv')->middleware('can:two-auth');
		Route::post('/create','AdminAdvertisementController@store');
		Route::get('/update/{id}','AdminAdvertisementController@edit')->name('admin.get.edit.adv')->middleware('can:two-auth');
		Route::post('/update/{id}','AdminAdvertisementController@update')->middleware('can:two-auth');
		Route::get('/detroy/{id}','AdminAdvertisementController@detroyX')->name('admin.get.detroy.adv')->middleware('can:two-auth');
	});
	Route::group(['prefix' => 'banner'],function(){
		Route::get('/','AdminBannnerController@index') -> name('admin.get.list.banner')->middleware('can:two-auth');
		Route::get('/create','AdminBannnerController@create') -> name('admin.get.create.banner')->middleware('can:two-auth');
		Route::post('/create','AdminBannnerController@store')->middleware('can:two-auth');
		Route::get('/update/{id}','AdminBannnerController@edit')->name('admin.get.edit.banner')->middleware('can:two-auth');
		Route::post('/update/{id}','AdminBannnerController@update')->middleware('can:two-auth');
		Route::get('/detroy/{id}','AdminBannnerController@detroyX')->name('admin.get.detroy.banner')->middleware('can:two-auth');
	});
	Route::group(['prefix' => 'buycart'],function(){
		Route::get('/','AdminBuycartController@index') -> name('admin.get.list.buycart')->middleware('can:three-auth');
		Route::get('/update','AdminBuycartController@updateStatus')-> name('updateStatus')->middleware('can:three-auth');
	});
	Route::group(['prefix' => 'user'],function(){
		Route::get('/all-user','AdminUserController@index') -> name('admin.get.list.user')->middleware('can:all-user');
		Route::get('/updateRole','AdminUserController@assign_roles') -> name('updateRoles')->middleware('can:all-user');
		Route::get('/create','AdminUserController@create') -> name('admin.get.create.user')->middleware('can:all-user');
		Route::post('/create','AdminUserController@store')->middleware('can:all-user');
		Route::get('/detroy/{id}','AdminUserController@detroyX')->name('admin.get.detroy.user')->middleware('can:all-user');
	});
});

//Authentication
//Route::get('register','AuthController@register')->name('register');