<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :后台信息
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;

class HomeController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
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
	****AuThor:rubbish.boy@163.com
	****Title :缓存布局设置
	*******************************************/
	public function api_setting(Request $request)
	{
		$attributes = $request->get('layout_attributes');
		$getdata=$request->all();
		$prefix=strpos($attributes,"_");
		if($prefix==6)
		{
			$getdata[$attributes]=$getdata[$attributes]==1?0:1;
		}
		else
		{
			$getdata['skin_blue']=0;
			$getdata['skin_black']=0;
			$getdata['skin_purple']=0;
			$getdata['skin_green']=0;
			$getdata['skin_red']=0;
			$getdata['skin_yellow']=0;
			$getdata['skin_blue_light']=0;
			$getdata['skin_black_light']=0;
			$getdata['skin_purple_light']=0;
			$getdata['skin_green_light']=0;
			$getdata['skin_red_light']=0;
			$getdata['skin_yellow_light']=0;

			$getdata[$attributes]=1;
		}
		
		Cache::store('file')->forever('setting', $getdata);
		$msg_array['status']='1';
		$msg_array['info']=trans('admin.website_action_set_success');
		$msg_array['is_reload']=1;
		$msg_array['resource']=$getdata;
		
        return response()->json($msg_array);

	}

}
