<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
	/******************************************
	****AuThor:rubbish@163.com
	****Title :处理系统缓存
	*******************************************/
	public function saveaction(Request $request)
	{
		$code = $request->get('action_type');
		if($code =='save')
		{
			$getdata=$request->all();
			Cache::forever('root', $getdata);
			
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_save_success');
			$msg_array['is_reload']=0;
			$msg_array['resource']=$getdata;
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.website_save_failure');
			$msg_array['is_reload']=1;
			$msg_array['resource']="";
		}
        return response()->json($msg_array);

	}
}
