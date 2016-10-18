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
		$website['apiurl_cache']=URL::action('Admin\CacheapiController@api_cache');
		$website['cursitename']=trans('admin.website_navigation_two');
		$website['info']=Cache::store('file')->get('root');
		$editoroption[]=array('text'=>trans('admin.website_setting_editor_item1'),'value'=>'Markdown');
		$editoroption[]=array('text'=>trans('admin.website_setting_editor_item2'),'value'=>'Ueditor');
		$website['editoroption']=json_encode($editoroption);
		$website['modelname']=getCurrentControllerName();

		return view('admin/setting/setting')->with('website',$website);
	}

}
