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
	/******************************************
	****AuThor:rubbish@163.com
	****Title :处理系统缓存
	*******************************************/
	public function saveaction(Request $request)
	{
		$code = $request->get('action_type');
		if($code =='save')
		{
			$setting['systitle']=$request->get('systitle');
			$setting['syskeyword']=$request->get('syskeyword');
			$setting['sysdescription']=$request->get('sysdescription');
			$setting['sysicp']=$request->get('sysicp');
			$setting['sysmaster']=$request->get('sysmaster');
			$setting['sysemail']=$request->get('sysemail');
			$setting['sysmobile']=$request->get('sysmobile');
			$setting['sysfax']=$request->get('sysfax');
			$setting['sysqq']=$request->get('sysqq');
			$setting['syswechat']=$request->get('syswechat');
			$setting['syscompany']=$request->get('syscompany');
			$setting['sysaddress']=$request->get('sysaddress');
			$setting['syscoordinate_h']=$request->get('syscoordinate_h');
			$setting['syscoordinate_w']=$request->get('syscoordinate_w');

			Cache::forever('root', $setting);

			$msg_array['data']['resource']=$setting;
			$msg_array['data']['is_reload']=0;
			$msg_array['info']=trans('admin.website_save_success');
			$json_message=json_message(1,$msg_array['data'],$msg_array['info']);

		}
		else
		{
			$msg_array['data']['is_reload']=1;
			$msg_array['info']=trans('admin.website_save_failure');
			$json_message=json_message(2,$msg_array['data'],$msg_array['info']);
		}
		
        return $json_message;

	}
}
