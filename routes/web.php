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
//app()->setLocale('iw');
//echo Config::get('app.locale');
Route::view('/', 'welcome');



Route::group(['middleware' => ['auth', 'checkmodule'],'prefix' => config('constant.backend')], function () {

	Route::get('/', 'AdminHomeController@index');
	Route::post('/changeLanguage', 'AdminUserController@changeLanguage');
	Route::get('logout', 'Auth\LoginController@logOut')->name('logout');

	Route::group(['prefix' => 'translation'], function () {
		Route::get('/', 'AdminTranslationController@index');
		Route::get('add', 'AdminTranslationController@add');
		Route::post('store', 'AdminTranslationController@store');
		Route::get('edit/{id}', 'AdminTranslationController@edit');
		Route::post('update', 'AdminTranslationController@update');
		Route::get('delete/{id}', 'AdminTranslationController@delete');
		

		Route::get('/module/{module_id}', 'AdminTranslationController@molduleIndex');
		Route::get('module/add/{module_id}', 'AdminTranslationController@moduleAdd');
		Route::post('module/store', 'AdminTranslationController@moduleStore');
		Route::get('module/edit/{module_id}/{id}', 'AdminTranslationController@moduleEdit');
		Route::post('module/update', 'AdminTranslationController@moduleUpdate');
		Route::get('module/delete/{module_id}/{id}', 'AdminTranslationController@moduleDelete');

		
	});

	Route::group(['prefix' => 'module'], function () {
		Route::get('/', 'AdminModulesController@index');
		Route::get('add', 'AdminModulesController@add');
		Route::post('store', 'AdminModulesController@store');
		Route::get('edit/{id}', 'AdminModulesController@edit');
		Route::post('update', 'AdminModulesController@update');
		Route::get('delete/{id}', 'AdminModulesController@delete');
	});

	Route::group(['prefix' => 'user'], function () {
		Route::get('/', 'AdminUserController@index');
		Route::get('add', 'AdminUserController@add');
		Route::post('store', 'AdminUserController@store');
		Route::get('edit/{id}', 'AdminUserController@edit');
		Route::post('update', 'AdminUserController@update');
		Route::get('delete/{id}', 'AdminUserController@delete');
		Route::get('detail/{id}', 'AdminUserController@detail');
		Route::post('multiDelete', 'AdminUserController@multiDelete');
		Route::post('multiActive', 'AdminUserController@multiActive');
		Route::post('multiInActive', 'AdminUserController@multiInActive');
		Route::post('getCountryCode', 'AdminUserController@getCountryCode');
	});

	Route::group(['prefix' => 'settings'], function () {
		Route::get('/', 'AdminSettingsController@index');
		Route::post('checkSlug', 'AdminSettingsController@checkSlug');
		Route::get('add', 'AdminSettingsController@add');
		Route::post('store', 'AdminSettingsController@store');
		Route::get('edit/{id}', 'AdminSettingsController@edit');
		Route::post('update', 'AdminSettingsController@update');
		Route::get('delete/{id}', 'AdminSettingsController@delete');
	});

	Route::group(['prefix' => 'country'], function () {
		Route::get('/', 'AdminCountryController@index');
		Route::get('add', 'AdminCountryController@add');
		Route::post('store', 'AdminCountryController@store');
		Route::get('edit/{id}', 'AdminCountryController@edit');
		Route::post('update', 'AdminCountryController@update');
		Route::get('delete/{id}', 'AdminCountryController@delete');
	});

	Route::group(['prefix' => 'skills'], function () {
		Route::get('/', 'AdminSkillsController@index');
		Route::get('add', 'AdminSkillsController@add');
		Route::post('store', 'AdminSkillsController@store');
		Route::get('edit/{id}', 'AdminSkillsController@edit');
		Route::post('update', 'AdminSkillsController@update');
		Route::get('delete/{id}', 'AdminSkillsController@delete');
	});

	Route::group(['prefix' => 'users-skills'], function () {
		Route::get('/', 'AdminUsersSkillsController@index');
		Route::get('assign/{id}', 'AdminUsersSkillsController@assign');
		Route::post('store', 'AdminUsersSkillsController@store');
		
	});

	Route::group(['prefix' => 'roles'], function () {
		Route::get('/', 'AdminRolesController@index');
		Route::get('add', 'AdminRolesController@add');
		Route::post('store', 'AdminRolesController@store');
		Route::get('edit/{id}', 'AdminRolesController@edit');
		Route::post('update', 'AdminRolesController@update');
		Route::get('delete/{id}', 'AdminRolesController@delete');
	});
	Route::get('exportUsers', 'AdminUserController@exportUsers');
	

});

Route::group(['before' => 'auth','prefix' => 'admin'], function(){
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@doLogin');

	//Route::get('login/otp', 'Auth\LoginOtpController@showOtpLoginForm');	
	//Route::get('login', 'Auth\LoginOtpController@showOtpLoginForm')->name('login');
	//Route::post('sendOTP', 'Auth\LoginOtpController@sendOTP');
	//Route::post('otpLogin', 'Auth\LoginOtpController@otpLogin');
});


