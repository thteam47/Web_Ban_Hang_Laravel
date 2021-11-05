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

Route::group(['middleware'=>'CheckPassExpires'],function(){
	Route::get('/', 'WebbhController@index')->name('home');
	Route::get('/details/{id}/{slug}.html', 'WebbhController@getDetails')->name('getDetails');
	Route::post('/details/{id}/{slug}.html', 'WebbhController@postComment')->middleware('throttle:5,1');
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
});
Route::group(['prefix'=>'login','middleware'=>'CheckLoginUser'],function(){
	Route::get('/','LoginController@index')->name('loginUser');
	Route::post('/','LoginController@postLogin')->middleware('throttle:5,1');
	Route::get('/resetPass','ForgotpassController@index')->name('resetPass');
	Route::post('/resetPass','ForgotpassController@postReset');
	Route::get('/changeResetPass','ForgotpassController@vieww')->name('changeResetPass');
	Route::post('/changeResetPass','ForgotpassController@postchangeResetPass');
});
Route::group(['prefix'=>'profile','middleware'=>'CheckUser'],function(){
	Route::get('user','ProfileUserController@index')->name('profile');
	Route::get('/logoutUser','ProfileUserController@getLogout')->name('logoutUser');
	Route::get('/changePass','ProfileUserController@vieww')->name('changePass');
	Route::post('/changePass','ProfileUserController@postchangePass');
});
Route::group(['prefix'=>'register','middleware'=>'CheckLoginUser'],function(){
	Route::get('/','RegisterController@index')->name('register');
	Route::post('/','RegisterController@postRegister');
});
Route::group(['prefix'=>'register'],function(){
	Route::get('verifyemail','RegisterController@viewVerity')->name('verifyemail');
	Route::get('/checkverifyemail/{url}','RegisterController@checkVetify');
	Route::get('/reverifyemail','RegisterController@RecheckVetify')->name('Reverifyemail')->middleware('CheckVerify');
});


