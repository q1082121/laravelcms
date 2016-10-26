<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :公共控制器
*******************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//使用数据库操作DB
use DB;
use Session;
//使用内存缓存
use Redis;
use Cache;
use Carbon;
use Redirect;
use URL;
class PublicController extends Controller
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :后台首页
	*******************************************/
	public function __construct()
	{
		/*
	    |--------------------------------------------------------------------------
	    | 默认消息 - 前台全局设置
	    |--------------------------------------------------------------------------
	    |
	    */
		//系统设置缓存
		$this->root=Cache::store('file')->get('root');
		//文章栏目缓存
		$this->cache_class=Cache::store('file')->get('class');
		//链接栏目缓存
		$this->cache_classlink=Cache::store('file')->get('classlink');
		//广告图片缓存
		$this->cache_picture=Cache::store('file')->get('picture');
		//友情链接缓存
		$this->cache_link=Cache::store('file')->get('link');

		$this->website['root']=@$this->root;
		$this->website['cache_class']=@$this->cache_class;
		$this->website['cache_classlink']=@$this->cache_classlink;
		$this->website['cache_picture']=@$this->cache_picture;
		$this->website['cache_link']=@$this->cache_link;
		
	}
}
