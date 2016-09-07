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
		//dump($this->userinfo);
		return view('admin/home');
	}
}
