<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//验证
use Illuminate\Support\Facades\Auth;
//使用数据库操作DB
use DB;

//引用对应的命名空间 debug 插件
use Validator;
use Gregwar\Captcha\CaptchaBuilder;
use Session;

//使用内存缓存
use Redis;
use Cache;
use Carbon;

//使用User模型
use App\Http\Model\User;
use Redirect;

use Entrust;

//使用URL生成地址
use URL;
// 导入 Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class PublicController extends Controller
{
	protected $userinfo;
	protected $website;
	/******************************************
	****AuThor:rubbish@163.com
	****Title :后台首页
	*******************************************/
	public function __construct()
	{
		/*
	    |--------------------------------------------------------------------------
	    | 默认消息 - 后台全局设置
	    |--------------------------------------------------------------------------
	    |
	    */
		//后台通用参数设置
		$root=Cache::store('file')->get('root');
		$layout=Cache::store('file')->get('layout');
		$layoutdata['layout_fixed']=0;
		$layoutdata['layout_boxed']=0;
		$layoutdata['layout_sidebar_collapse']=0;
		$layoutdata['layout_expandOnHover']=0;
		$layoutdata['layout_control_sidebar_open']=0;
		$layoutdata['layout_toggle']=0;
		$this->website['layout']=$layout?$layout:$layoutdata;
		//dump($layout);
		$this->website['website_seo_title']=($root['systitle']?$root['systitle']:trans('admin.website_name'));
		$this->website['website_seo_keyword']=$root['syskeyword'];
		$this->website['website_seo_description']=$root['sysdescription'];
		$this->website['apiurl_layout']=URL::action('Admin\HomeController@api_layout');

		//常量定义
		$this->pagesize=$pagesize=env('APP_ADMIN_PAGE_SIZE', 20);					//分页
		$this->is_watermark=$is_watermark=env('APP_IS_WATERMARK', 1);				//是否水印
		$this->is_thumb=$is_thumb=env('APP_IS_THUMB', 1);							//是否缩略图
		$this->thumb_width=$thumb_width=env('APP_THUMB_WIDTH', 200);				//缩略图宽度
		$this->thumb_height=$thumb_height=env('APP_THUMB_HEIGHT', 200);				//缩略图高度
		

		//默认分类模块
		$this->modellist[]=array('text'=>trans('admin.website_model_info'),'value'=>1);
		$this->modellist[]=array('text'=>trans('admin.website_model_product'),'value'=>2);

		/*
	    |--------------------------------------------------------------------------
	    | 默认消息 - 验证信息
	    |--------------------------------------------------------------------------
	    |
	    */
	    //是否验证通过
		$guard="admin";
	    if (Auth::guard($guard)->check()) 
        {
        	//获取用户信息
            $user=Auth::guard($guard)->user();
            $cache_userinfo='userinfo_'.$user['id'];

			$default_data_cache_type="redis";
			switch($default_data_cache_type)
			{
				case 'file':
							//file 版缓存
							if (Cache::has($cache_userinfo)) 
							{
								
							}
							else
							{
								$userinfo=User::find($user['id'])->hasOneUserinfo;
								$minutes=1800;
								Cache::put($cache_userinfo, $userinfo, $minutes);
							}
							$this->userinfo=Cache::get($cache_userinfo);
							break;
				case 'redis':
							//Redis 版缓存
							if (Redis::get($cache_userinfo)) 
							{
							
							}
							else
							{
								$userinfo=User::find($user['id'])->hasOneUserinfo;
								Redis::set($cache_userinfo,$userinfo);
							}
							$this->userinfo=json_decode(Redis::get($cache_userinfo),true);
							break;
			}

			$this->user=$user;
			//dump($this->userinfo);
			//dump($this->user);

			//用户信息
			$this->website['website_userinfo']=$this->userinfo;
			//用户
			$this->website['website_user']=$this->user;

			//用户角色组判断
			if(Entrust::hasRole(['admin', 'subadmin']) == false )
			{
				alert('/user/logout',trans('admin.website_user_role_failure'));
			}
        }
		else
		{	
				alert('/user/login',trans('admin.website_user_role_login'));
		}
        
		
	}

	/******************************************
	****AuThor:rubbish@163.com
	****Title :图片上传
	*******************************************/
	public function uploads_action($classname,$data_image)
	{
		// 引入 composer autoload
		$suffix='.png';
		require base_path('vendor').'/autoload.php';
		//上传文件夹路径
		$uploads_dir=public_path('uploads');
		//上传日期时间
		$datetime=date('YmdHis');
		//水印图片路径
		$watermark_dir=public_path('watermark').'/logo.png';
		$datetimename=$datetime.$suffix;
		//保存文件名
		$filename=$uploads_dir.'/'.$classname.'/'.$datetimename;
		$watermark_filename=$uploads_dir.'/'.$classname.'/watermark/'.$datetimename;
		$thumb_filename=$uploads_dir.'/'.$classname.'/thumb/'.$datetimename;


		if($this->is_watermark==1)
		{	
			if(!is_dir($uploads_dir.'/'.$classname.'/watermark/')) 
			{
				mkdir($uploads_dir.'/'.$classname.'/watermark/', 0777, true);
			}
			// 合成水印
			$img = Image::make($data_image)->insert($watermark_dir, 'bottom-right', 15, 10)->save($watermark_filename);

			
		}
		if($this->is_thumb==1)
		{
			if(!is_dir($uploads_dir.'/'.$classname.'/thumb/')) 
			{
				mkdir($uploads_dir.'/'.$classname.'/thumb/', 0777, true);
			}
			// 生成缩略图
			$img = Image::make($data_image)->resize($this->thumb_width,$this->thumb_height)->save($thumb_filename);
		
			
		}

		if(!is_dir($uploads_dir.'/'.$classname.'/')) 
		{
			mkdir($uploads_dir.'/'.$classname.'/', 0777, true);
		}

		// 将处理后的图片重新保存到其他路径
		Image::make($data_image)->save($filename);

		return $datetimename;

	}

	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 删除图片
	****@return : Response
	*******************************************/
	public function del_image_action($classname,$attachment)
	{
		
		//上传文件夹路径
		$uploads_dir=public_path('uploads');
		//保存文件名
		$filename=$uploads_dir.'/'.$classname.'/'.$attachment;
		$watermark_filename=$uploads_dir.'/'.$classname.'/watermark/'.$attachment;
		$thumb_filename=$uploads_dir.'/'.$classname.'/thumb/'.$attachment;

		
		if (file_exists($watermark_filename)) 
		{
		    unlink ($watermark_filename);
		}
		if (file_exists($thumb_filename)) 
		{
		    unlink ($thumb_filename);
		}
		if (file_exists($filename)) 
		{
		    $result=unlink ($filename);
		}

		return $result;
	}
}
