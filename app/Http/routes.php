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
Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {  
    Route::get('/', 'HomeController@index');
	Route::resource('article', 'ArticleController');
});


