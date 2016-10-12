<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;

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
	/******************************************
	****AuThor:rubbish@163.com
	****Title :缓存布局设置
	*******************************************/
	public function api_layout(Request $request)
	{
		$attributes = $request->get('layout_attributes');
		$getdata=$request->all();
		$getdata[$attributes]=$getdata[$attributes]==1?0:1;
		Cache::store('file')->forever('layout', $getdata);
		$msg_array['status']='1';
		$msg_array['info']=trans('admin.website_action_set_success');
		$msg_array['is_reload']=1;
		$msg_array['resource']=$getdata;
		
        return response()->json($msg_array);

	}

}
