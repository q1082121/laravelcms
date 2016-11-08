<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :公共控制器
*******************************************/
namespace App\Http\Controllers\Wechat;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//使用数据库操作DB
use DB;
use Session;
//使用内存缓存
use Redis;
use Cache;
use Carbon;
use URL;
// 导入 Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
class PublicController extends Controller
{
	protected $website;
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :后台首页
	*******************************************/
	public function __construct()
	{
		/*
	    |--------------------------------------------------------------------------
	    | 默认消息 - 后台通用参数设置
	    |--------------------------------------------------------------------------
	    |
	    */
		
		$root=Cache::store('file')->get('root');
		$root['syseditor']=@$root['syseditor']?@$root['syseditor']:"Markdown";
		$root['systitle']=@$root['systitle']?@$root['systitle']:"LaravelCms";
		$root['syskeywords']=@$root['syskeywords']?@$root['syskeywords']:"";
		$root['sysdescription']=@$root['sysdescription']?@$root['sysdescription']:"";
		$this->website['website_seo_title']=(@$root['systitle']?@$root['systitle']:trans('admin.website_name'));
		$this->website['website_seo_keywords']=@$root['syskeywords'];
		$this->website['website_seo_description']=@$root['sysdescription'];
		$this->website['root']=$this->root=@$root;
	}
	
}
