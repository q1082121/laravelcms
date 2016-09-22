<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class UserController extends PublicController
{
	/******************************************
	****AuThor:rubbish@163.com
	****Title :用户列表
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_five');
		return view('admin/user/user')->with('website',$website);
	}
}
