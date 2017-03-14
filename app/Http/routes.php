<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/profile/{user}', 'UserController@show');

Route::get('/change-password', function(){
	return view('address.change-password'); 
});

Route::post('/change-password', 'UserController@change_password');

Route::get('/','PagesController@home');

Route::get('/state/{state}', 'StateController@state');

Route::post('/state/{state}/district', 'DistrictController@store');

Route::get('/district/{district}/edit', 'DistrictController@edit');

Route::patch('/district/{district}', 'DistrictController@update');

Route::auth();

Route::get('/first', function () {
	Session::flash('status', 'Hi! Welcome back');
	
	return redirect('/home');
});

Route::get('/home', 'StateController@index');

Route::get('/district/{district}/delete', 'DistrictController@delete');

Route::get('/district/{district}/addresses', 'AddressController@district');

Route::post('/district/{district}/add-address', 'AddressController@store');

Route::get('/address/{address}', 'AddressController@show');

Route::post('/state/add-state', 'StateController@store');

Route::get('/state/{state}/delete', 'StateController@delete');

Route::get('/add/address', 'AddressController@index');

Route::post('/address/delete', 'AddressController@delete');

Route::patch('/address/edit/', 'AddressController@update');

Route::get('/search', 'AddressController@search');