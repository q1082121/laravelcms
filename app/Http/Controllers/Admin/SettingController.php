<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//使用内存缓存
use Redis;
use Cache;

class SettingController extends PublicController
{
	/******************************************
	****AuThor:rubbish@163.com
	****Title :后台首页
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_two');
		$website['info']=Cache::get('root');
		return view('admin/setting/setting')->with('website',$website);
	}
	
}
