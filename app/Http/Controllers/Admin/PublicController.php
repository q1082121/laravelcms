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


class PublicController extends Controller
{
	protected $userinfo;

	/******************************************
	****AuThor:rubbish@163.com
	****Title :后台首页
	*******************************************/
	public function __construct()
	{
	    //是否验证通过
	    if (Auth::check()) 
        {
        	//获取用户信息
            $this->userinfo=$user=Auth::user();
            
        }

	}
}
