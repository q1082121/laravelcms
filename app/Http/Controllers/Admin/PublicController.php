<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//验证
use Illuminate\Support\Facades\Auth;
//使用数据库操作DB
use DB;

//引用对应的命名空间 debug 插件
use Validator;
use Gregwar\Captcha\CaptchaBuilder;
use Session;

//使用内存缓存
use Redis;
use Cache;
use Carbon;

//使用User模型
use App\Http\Model\User;
use Redirect;

use Entrust;

class PublicController extends Controller
{
	protected $userinfo;
	protected $website;
	/******************************************
	****AuThor:rubbish@163.com
	****Title :后台首页
	*******************************************/
	public function __construct()
	{
		/*
	    |--------------------------------------------------------------------------
	    | 默认消息 - 后台全局设置
	    |--------------------------------------------------------------------------
	    |
	    */
		//后台通用参数设置
		$root=Cache::get('root');
		$this->website['website_seo_title']=($root['systitle']?$root['systitle']:trans('admin.website_name'));
		$this->website['website_seo_keyword']=$root['syskeyword'];
		$this->website['website_seo_description']=$root['sysdescription'];

		//常量定义
		$this->pagesize=$pagesize=env('APP_ADMIN_PAGE_SIZE', 20);					//分页
		$this->is_watermark=$is_watermark=env('APP_IS_WATERMARK', 1);				//是否水印
		$this->is_thumb=$is_thumb=env('APP_IS_THUMB', 1);							//是否缩略图
		$this->thumb_width=$thumb_width=env('APP_THUMB_WIDTH', 200);				//缩略图宽度
		$this->thumb_height=$thumb_height=env('APP_THUMB_HEIGHT', 200);				//缩略图高度
		

		//默认常量数据
		$this->modellist[]=array('text'=>trans('admin.website_model_info'),'value'=>1);
		$this->modellist[]=array('text'=>trans('admin.website_model_product'),'value'=>2);

		/*
	    |--------------------------------------------------------------------------
	    | 默认消息 - 验证信息
	    |--------------------------------------------------------------------------
	    |
	    */
	    //是否验证通过
		$guard="admin";
	    if (Auth::guard($guard)->check()) 
        {
        	//获取用户信息
            $user=Auth::guard($guard)->user();
            $cache_userinfo='userinfo_'.$user['id'];

			$default_data_cache_type="redis";
			switch($default_data_cache_type)
			{
				case 'file':
							//file 版缓存
							if (Cache::has($cache_userinfo)) 
							{
								
							}
							else
							{
								$userinfo=User::find($user['id'])->hasOneUserinfo;
								$minutes=1800;
								Cache::put($cache_userinfo, $userinfo, $minutes);
							}
							$this->userinfo=Cache::get($cache_userinfo);
							break;
				case 'redis':
							//Redis 版缓存
							if (Redis::get($cache_userinfo)) 
							{
							
							}
							else
							{
								$userinfo=User::find($user['id'])->hasOneUserinfo;
								Redis::set($cache_userinfo,$userinfo);
							}
							$this->userinfo=json_decode(Redis::get($cache_userinfo),true);
							break;
			}

			$this->user=$user;
			//dump($this->userinfo);
			//dump($this->user);

			//用户信息
			$this->website['website_userinfo']=$this->userinfo;
			//用户
			$this->website['website_user']=$this->user;

			//用户角色组判断
			if(Entrust::hasRole(['admin', 'subadmin']) == false )
			{
				alert('/user/logout',trans('admin.website_user_role_failure'));
			}
        }
		else
		{	
				alert('/user/login',trans('admin.website_user_role_login'));
		}
        
		
	}
}
