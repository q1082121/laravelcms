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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

//Route::auth();
/******************************************
****@AuThor:rubbish@163.com
****@Title :会员中心
*******************************************/
Route::group(['namespace' => 'User', 'prefix' => 'user'], function() {  
    /******************************************
	****@AuThor:rubbish@163.com
	****@Title :会员注册
	*******************************************/
	Route::get('register/{type?}','RegisterController@register');
	Route::get('register/captcha/{tmp}', 'RegisterController@captcha');
	Route::post('register', 'RegisterController@store');
	/******************************************
	****@AuThor:rubbish@163.com
	****@Title :会员登录
	*******************************************/
	Route::get('login/{type?}','LoginController@login');
	Route::get('login/captcha/{tmp}', 'LoginController@captcha');
	Route::post('login', 'LoginController@login_action');
	/******************************************
	****@AuThor:rubbish@163.com
	****@Title :退出登录
	*******************************************/
	Route::get('logout','LoginController@logout');
});


/******************************************
****@AuThor:rubbish@163.com
****@Title :前台访问控制
*******************************************/
Route::get('/', 'HomeController@index');
Route::get('article/{id}', 'ArticleController@show');
Route::post('comment', 'CommentController@store');
/******************************************
****@AuThor:rubbish@163.com
****@Title :后台访问需登录控制
*******************************************/
Route::group(['middleware' => 'auth_admin', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {  
	/*
	 ***********************************************************************
	 *	   get 路由
	 ***********************************************************************
	 */	
    Route::get('/', 'HomeController@index');
	Route::get('setting', 'SettingController@index');

	Route::get('user', 'UserController@index');

	Route::get('userrole', 'UserroleController@index');
	Route::get('userrole/add', 'UserroleController@add');
	Route::get('userrole/edit/{id}', 'UserroleController@edit');

	Route::get('userpermission', 'UserpermissionController@index');
	Route::get('userpermission/add', 'UserpermissionController@add');
	Route::get('userpermission/edit/{id}', 'UserpermissionController@edit');
	/*
	 ***********************************************************************
	 *	   post 路由
	 ***********************************************************************
	 */	
	Route::post('user/api_list', 'UserController@api_list');

	Route::post('userrole/api_list', 'UserroleController@api_list');
	Route::post('userrole/api_add', 'UserroleController@api_add');
	Route::post('userrole/api_info', 'UserroleController@api_info');
	Route::post('userrole/api_edit', 'UserroleController@api_edit');

	Route::post('userpermission/api_list', 'UserpermissionController@api_list');
	Route::post('userpermission/api_add', 'UserpermissionController@api_add');
	Route::post('userpermission/api_info', 'UserpermissionController@api_info');
	Route::post('userpermission/api_edit', 'UserpermissionController@api_edit');

	Route::post('setting', 'SettingController@saveaction');
	Route::resource('article', 'ArticleController');
});

Route::get('/home', 'HomeController@index');
