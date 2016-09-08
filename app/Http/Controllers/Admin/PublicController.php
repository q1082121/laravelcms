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
			$this->user=$user;
        }
        //用户信息
		$this->website['website_userinfo']=$this->userinfo;
		//用户
		$this->website['website_user']=$this->user;
	}
}
