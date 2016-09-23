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
	/******************************************
	****AuThor:rubbish@163.com
	****Title :用户列表_数据_api
	*******************************************/
	public function api_user_list(Request $request)  
	{
		$list="";
		if($list)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_get_success');
			$msg_array['is_reload']=0;
			$msg_array['resource']=$list;
		}
		else
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_get_empty');
			$msg_array['is_reload']=0;
			$msg_array['resource']="";
		}
        return response()->json($msg_array);
	}
}
