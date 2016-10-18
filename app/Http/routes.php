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
****@AuThor:rubbish.boy@163.com
****@Title :会员中心
*******************************************/
Route::group(['namespace' => 'User', 'prefix' => 'user'], function() {  
    /******************************************
	****@AuThor:rubbish.boy@163.com
	****@Title :会员注册
	*******************************************/
	Route::get('register/{type?}','RegisterController@register');
	Route::get('register/captcha/{tmp}', 'RegisterController@captcha');
	Route::post('register', 'RegisterController@store');
	/******************************************
	****@AuThor:rubbish.boy@163.com
	****@Title :会员登录
	*******************************************/
	Route::get('login/{type?}','LoginController@login');
	Route::get('login/captcha/{tmp}', 'LoginController@captcha');
	Route::post('login', 'LoginController@login_action');
	/******************************************
	****@AuThor:rubbish.boy@163.com
	****@Title :退出登录
	*******************************************/
	Route::get('logout','LoginController@logout');
});


/******************************************
****@AuThor:rubbish.boy@163.com
****@Title :前台访问控制
*******************************************/
Route::get('/', 'HomeController@index');
Route::get('article/{id}', 'ArticleController@show');
Route::post('comment', 'CommentController@store');
/******************************************
****@AuThor:rubbish.boy@163.com
****@Title :后台访问需登录控制
*******************************************/
Route::group(['middleware' => 'auth_admin', 'namespace' => 'Admin', 'prefix' => 'admin'], function() {  
	/*
	 ***********************************************************************
	 *	   get 路由
	 ***********************************************************************
	 */	
    Route::get('/', 'HomeController@index');
	
	Route::get('setting', 
				[
			        'middleware' => ['ability:admin,model_setting'], 
			        'uses' => 'SettingController@index'
    			]);

	Route::get('user', 
				[
			        'middleware' => ['ability:admin,model_user'], 
			        'uses' => 'UserController@index'
    			]);
	Route::get('userinfo', 
				[
			        'middleware' => ['ability:admin,set_userinfo'], 
			        'uses' => 'UserController@userinfo'
    			]);
	Route::get('edit_pwd', 
				[
			        'middleware' => ['ability:admin,edit'], 
			        'uses' => 'UserController@edit_pwd'
    			]);
	Route::get('user/set/{id}', 
				[
			        'middleware' => ['ability:admin,set_role'], 
			        'uses' => 'UserController@set'
    			]);
	//用户角色			
	Route::get('userrole', 
				[
			        'middleware' => ['ability:admin,model_role'], 
			        'uses' => 'UserroleController@index'
    			]);
	Route::get('userrole/add', 
				[
			        'middleware' => ['ability:admin,add'], 
			        'uses' => 'UserroleController@add'
    			]);
	Route::get('userrole/edit/{id}', 
				[
			        'middleware' => ['ability:admin,edit'], 
			        'uses' => 'UserroleController@edit'
    			]);
	Route::get('userrole/set/{id}', 
				[
			        'middleware' => ['ability:admin,set_permission'], 
			        'uses' => 'UserroleController@set'
    			]);
	//角色权限				
	Route::get('userpermission', 
				[
			        'middleware' => ['ability:admin,model_permission'], 
			        'uses' => 'UserpermissionController@index'
    			]);
	Route::get('userpermission/add', 
				[
			        'middleware' => ['ability:admin,add'], 
			        'uses' => 'UserpermissionController@add'
    			]);
	Route::get('userpermission/edit/{id}', 
				[
			        'middleware' => ['ability:admin,edit'], 
			        'uses' => 'UserpermissionController@edit'
    			]);
	//栏目分类			
	Route::get('classify', 
				[
			        'middleware' => ['ability:admin,model_classify'], 
			        'uses' => 'ClassifyController@index'
    			]);
	Route::get('classify/add', 
				[
			        'middleware' => ['ability:admin,add'], 
			        'uses' => 'ClassifyController@add'
    			]);
	Route::get('classify/edit/{id}', 
				[
			        'middleware' => ['ability:admin,edit'], 
			        'uses' => 'ClassifyController@edit'
    			]);
	//文章资讯				
	Route::get('article', 
				[
			        'middleware' => ['ability:admin,model_article'], 
			        'uses' => 'ArticleController@index'
    			]);
	Route::get('article/add', 
				[
			        'middleware' => ['ability:admin,add'], 
			        'uses' => 'ArticleController@add'
    			]);
	Route::get('article/edit/{id}', 
				[
			        'middleware' => ['ability:admin,edit'], 
			        'uses' => 'ArticleController@edit'
    			]);						
	/*
	 ***********************************************************************
	 *	   post 路由
	 ***********************************************************************
	 */	
	Route::post('home/api_setting', 'HomeController@api_setting');

	Route::post('cacheapi/api_cache', 'CacheapiController@api_cache');
	Route::post('district/api_area', 'DistrictController@api_area');

	Route::post('deleteapi/api_delete', 'DeleteapiController@api_delete');
	Route::post('deleteapi/api_del_image', 'DeleteapiController@api_del_image');

	Route::post('markdownupload', 'MarkdownapiController@upload');
	Route::post('oneactionapi/api_one_action', 'OneactionapiController@api_one_action');

	Route::post('user/api_list', 'UserController@api_list');
	Route::post('user/api_get_one', 'UserController@api_get_one');
	Route::post('user/api_edit_pwd', 'UserController@api_edit_pwd');
	Route::post('userinfo/api_info', 'UserController@api_info');
	Route::post('userinfo/api_edit', 'UserController@api_edit');

	Route::post('userrole/api_list', 'UserroleController@api_list');
	Route::post('userrole/api_get_role', 'UserroleController@api_get_role');
	Route::post('userrole/api_cancel_role', 'UserroleController@api_cancel_role');
	Route::post('userrole/api_list_related', 'UserroleController@api_list_related');
	Route::post('userrole/api_add', 'UserroleController@api_add');
	Route::post('userrole/api_info', 'UserroleController@api_info');
	Route::post('userrole/api_edit', 'UserroleController@api_edit');

	Route::post('userpermission/api_list', 'UserpermissionController@api_list');
	Route::post('userpermission/api_get_permission', 'UserpermissionController@api_get_permission');
	Route::post('userpermission/api_cancel_permission', 'UserpermissionController@api_cancel_permission');
	Route::post('userpermission/api_list_related', 'UserpermissionController@api_list_related');
	Route::post('userpermission/api_add', 'UserpermissionController@api_add');
	Route::post('userpermission/api_info', 'UserpermissionController@api_info');
	Route::post('userpermission/api_edit', 'UserpermissionController@api_edit');

	Route::post('classify/api_list', 'ClassifyController@api_list');
	Route::post('classify/api_add', 'ClassifyController@api_add');
	Route::post('classify/api_info', 'ClassifyController@api_info');
	Route::post('classify/api_edit', 'ClassifyController@api_edit');

	Route::post('article/api_list', 'ArticleController@api_list');
	Route::post('article/api_add', 'ArticleController@api_add');
	Route::post('article/api_info', 'ArticleController@api_info');
	Route::post('article/api_edit', 'ArticleController@api_edit');

});

Route::get('/home', 'HomeController@index');

