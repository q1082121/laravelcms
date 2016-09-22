<?php

namespace App\Http\Controllers\Admin;

class HomeController extends PublicController
{
	/******************************************
	****AuThor:rubbish@163.com
	****Title :后台首页
	*******************************************/
	public function index()  
	{
		//dump($this->website);
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_one');
		//dump($this->userinfo);
		return view('admin/home')->with('website',$website);
	}
}
