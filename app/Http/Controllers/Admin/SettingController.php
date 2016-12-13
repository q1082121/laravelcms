<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :系统设置
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//使用内存缓存
use Redis;
use Cache;
//使用URL生成地址
use URL;

class SettingController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :后台首页
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_setting');
		$website['info']=$this->root;
		$editoroption[]=array('text'=>trans('admin.website_setting_editor_item1'),'value'=>'Markdown');
		$editoroption[]=array('text'=>trans('admin.website_setting_editor_item2'),'value'=>'Ueditor');
		$website['editoroption']=json_encode($editoroption);

		return view('admin/setting/setting')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :详情接口
	*******************************************/
	public function api_info(Request $request)  
	{
		
		$modelname=$request->get('modelname');
		if($modelname=='Setting')
		{
			$root=Cache::store('file')->get('root');
			if($root)
			{
				$msg_array['status']='1';
				$msg_array['info']=trans('admin.message_get_success');
				$msg_array['is_reload']=0;
				$msg_array['curl']='';
				$msg_array['resource']=$root;
			}
			else
			{
				$msg_array['status']='0';
				$msg_array['info']=trans('admin.message_get_empty');
				$msg_array['is_reload']=0;
				$msg_array['curl']='';
				$msg_array['resource']="";
			}
			
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_get_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		}
        return response()->json($msg_array);
	}

}
