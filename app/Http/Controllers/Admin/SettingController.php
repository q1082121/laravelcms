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

class SettingController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :后台首页
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_two');
		$website['info']=Cache::store('file')->get('root');
		$editoroption[]=array('text'=>trans('admin.website_setting_editor_item1'),'value'=>'Markdown');
		$editoroption[]=array('text'=>trans('admin.website_setting_editor_item2'),'value'=>'Ueditor');
		$website['editoroption']=json_encode($editoroption);
		return view('admin/setting/setting')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :处理系统缓存
	*******************************************/
	public function saveaction(Request $request)
	{

		$getdata=$request->all();
		Cache::store('file')->forever('root', $getdata);
		
		$msg_array['status']='1';
		$msg_array['info']=trans('admin.website_save_success');
		$msg_array['is_reload']=0;
		$msg_array['resource']=$getdata;

        return response()->json($msg_array);

	}
}
