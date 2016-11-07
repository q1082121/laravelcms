<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :公共控制器
*******************************************/
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
		$setting=Cache::store('file')->get('setting');
		/*
	    |--------------------------------------------------------------------------
	    | 默认消息 - 界面设置参数
	    |--------------------------------------------------------------------------
	    |
	    */
		$settingdata['layout_fixed']=0;
		$settingdata['layout_boxed']=0;
		$settingdata['layout_sidebar_collapse']=0;
		$settingdata['layout_expandOnHover']=0;
		$settingdata['layout_control_sidebar_open']=0;
		$settingdata['layout_toggle']=0;
		$settingdata['skin_blue']=0;
		$settingdata['skin_black']=0;
		$settingdata['skin_purple']=0;
		$settingdata['skin_green']=0;
		$settingdata['skin_red']=0;
		$settingdata['skin_yellow']=0;
		$settingdata['skin_blue_light']=0;
		$settingdata['skin_black_light']=0;
		$settingdata['skin_purple_light']=0;
		$settingdata['skin_green_light']=0;
		$settingdata['skin_red_light']=0;
		$settingdata['skin_yellow_light']=0;
		$this->website['setting']=$setting?$setting:$settingdata;
		$this->website['apiurl_setting']=URL::action('Admin\HomeController@api_setting');
		/*
	    |--------------------------------------------------------------------------
	    | 默认消息 - 定义数据
	    |--------------------------------------------------------------------------
	    |
	    */
		//常量定义
		$this->pagesize=$pagesize=env('APP_ADMIN_PAGE_SIZE', 20);					//分页
		$this->is_watermark=$is_watermark=env('APP_IS_WATERMARK', 1);				//是否水印
		$this->is_thumb=$is_thumb=env('APP_IS_THUMB', 1);							//是否缩略图
		$this->thumb_width=$thumb_width=env('APP_THUMB_WIDTH', 200);				//缩略图宽度
		$this->thumb_height=$thumb_height=env('APP_THUMB_HEIGHT', 200);				//缩略图高度

		//默认广告图片模块
		$this->picture_modellist[]=array('text'=>trans('admin.website_model_picture1'),'value'=>1);
		$this->picture_modellist[]=array('text'=>trans('admin.website_model_picture2'),'value'=>2);
		$this->picture_modellist[]=array('text'=>trans('admin.website_model_picture3'),'value'=>3);
		$this->picture_modellist[]=array('text'=>trans('admin.website_model_picture4'),'value'=>4);
		//默认友情链接模块
		$this->link_modellist[]=array('text'=>trans('admin.website_model_link1'),'value'=>1);
		$this->link_modellist[]=array('text'=>trans('admin.website_model_link2'),'value'=>2);
		//默认日志管理模块
		$this->log_modellist[]=array('text'=>trans('admin.website_model_log1'),'value'=>1);
		//默认微信公众号类型
		$this->wechat_modellist[]=array('text'=>trans('admin.website_model_wechat1'),'value'=>1);
		$this->wechat_modellist[]=array('text'=>trans('admin.website_model_wechat2'),'value'=>2);
		$this->wechat_modellist[]=array('text'=>trans('admin.website_model_wechat3'),'value'=>3);
		$this->wechat_modellist[]=array('text'=>trans('admin.website_model_wechat4'),'value'=>4);
		$this->wechat_modellist[]=array('text'=>trans('admin.website_model_wechat5'),'value'=>5);

		/*
	    |--------------------------------------------------------------------------
	    | 默认消息 - 验证信息
	    |--------------------------------------------------------------------------
	    |
	    */
		$guard="admin";
	    if (Auth::guard($guard)->check()) 
        {
        	//获取用户信息
            $user=Auth::guard($guard)->user();
            $cache_userinfo='userinfo_'.$user['id'];

			$default_session_cache_type=env('SESSION_DRIVER', "file");
			switch($default_session_cache_type)
			{
				case 'file':
							//file 版缓存
							if (Cache::store('file')->has($cache_userinfo)) 
							{
								
							}
							else
							{
								$userinfo=User::find($user['id'])->hasOneUserinfo;
								$minutes=3600;
								Cache::store('file')->put($cache_userinfo, $userinfo, $minutes);
							}
							$this->userinfo=Cache::store('file')->get($cache_userinfo);
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
			$this->userinfo['avatar']=$this->userinfo['isattach']==1?"/uploads/User/".$this->userinfo['attachment']:"/images/avatar/200.png";
			$this->website['website_userinfo']=$this->userinfo;
			$this->website['website_user']=$this->user;

			/*
			|--------------------------------------------------------------------------
			| 默认消息 - 用户角色组判断
			|--------------------------------------------------------------------------
			|
			*/
			if(Entrust::hasRole(['admin', 'subadmin']) == false )
			{
				alert('/user/logout',trans('admin.website_user_role_failure'));
			}
			else
			{
				//获取未读信件
				//index
				$condition_index['email_to']=$this->user['email'];
				$condition_index['istrash_to']=0;
				$condition_index['isdel_to']=0;
				$condition_index['status']=0;
				$letters_count=DB::table('letters')->where($condition_index)->count();
				$letters_list=DB::table('letters')->where($condition_index)->take(5)->get();
				$this->website['letters_count']=$letters_count?$letters_count:0;
				$this->website['letters_list']=json_encode(object_array($letters_list));
			}


        }
		else
		{	
				alert('/user/login',trans('admin.website_user_role_login'));
		}
        
		
	}

	/******************************************
	****AuThor:rubbish.boy@163.com
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

		switch($classname)
		{
			case "Navigation":

			break;
			case "Classify":

			break;
			case "Classifylink":

			break;
			case "Classifyproduct":

			break;
			case "Classifyquestion":

			break;
			case "Link":

			break;
			case "Question":

			break;
			case "Questionoption":

			break;
			case "User":

			break;
			case "Wechat":

			break;
			default:
					if($this->is_watermark==1)
					{	
						if(!is_dir($uploads_dir.'/'.$classname.'/watermark/')) 
						{
							mkdir($uploads_dir.'/'.$classname.'/watermark/', 0777, true);
						}
						// 合成水印
						$img = Image::make($data_image)->insert($watermark_dir, 'bottom-right', 15, 10)->save($watermark_filename);
					}
			break;
		}
		
		if($this->is_thumb==1)
		{
			switch($classname)
			{
				case 'Navigation':
								$thumb_width=@$this->root['navigation_thumb_width']?@$this->root['navigation_thumb_width']:$this->thumb_width;
								$thumb_height=@$this->root['navigation_thumb_height']?@$this->root['navigation_thumb_height']:$this->thumb_height;	
				break;
				case 'Classify':
								$thumb_width=@$this->root['classify_thumb_width']?@$this->root['classify_thumb_width']:$this->thumb_width;
								$thumb_height=@$this->root['classify_thumb_height']?@$this->root['classify_thumb_height']:$this->thumb_height;	
				break;
				case 'Classifylink':
								$thumb_width=@$this->root['classifylink_thumb_width']?@$this->root['classifylink_thumb_width']:$this->thumb_width;
								$thumb_height=@$this->root['classifylink_thumb_height']?@$this->root['classifylink_thumb_height']:$this->thumb_height;	
				break;
				case 'Classifyproduct':
								$thumb_width=@$this->root['classifyproduct_thumb_width']?@$this->root['classifyproduct_thumb_width']:$this->thumb_width;
								$thumb_height=@$this->root['classifyproduct_thumb_height']?@$this->root['classifyproduct_thumb_height']:$this->thumb_height;	
				break;
				case 'Classifyquestion':
								$thumb_width=@$this->root['classifyquestion_thumb_width']?@$this->root['classifyquestion_thumb_width']:$this->thumb_width;
								$thumb_height=@$this->root['classifyquestion_thumb_height']?@$this->root['classifyquestion_thumb_height']:$this->thumb_height;	
				break;
				case 'Article':
								$thumb_width=@$this->root['article_thumb_width']?@$this->root['article_thumb_width']:$this->thumb_width;
								$thumb_height=@$this->root['article_thumb_height']?@$this->root['article_thumb_height']:$this->thumb_height;	
				break;
				case 'Product':
								$thumb_width=@$this->root['product_thumb_width']?@$this->root['product_thumb_width']:$this->thumb_width;
								$thumb_height=@$this->root['product_thumb_height']?@$this->root['product_thumb_height']:$this->thumb_height;	
				break;
				case 'Picture':
								$thumb_width=@$this->root['picture_thumb_width']?@$this->root['picture_thumb_width']:$this->thumb_width;
								$thumb_height=@$this->root['picture_thumb_height']?@$this->root['picture_thumb_height']:$this->thumb_height;	
				break;
				case 'Link':
								$thumb_width=@$this->root['link_thumb_width']?@$this->root['link_thumb_width']:$this->thumb_width;
								$thumb_height=@$this->root['link_thumb_height']?@$this->root['link_thumb_height']:$this->thumb_height;	
				break;
				case 'Questionoption':
								$thumb_width=@$this->root['question_thumb_width']?@$this->root['question_thumb_width']:$this->thumb_width;
								$thumb_height=@$this->root['question_thumb_height']?@$this->root['question_thumb_height']:$this->thumb_height;	
				break;
				case 'Questionoption':
								$thumb_width=@$this->root['questionoption_thumb_width']?@$this->root['questionoption_thumb_width']:$this->thumb_width;
								$thumb_height=@$this->root['questionoption_thumb_height']?@$this->root['questionoption_thumb_height']:$this->thumb_height;	
				break;
				case 'User':
								$thumb_width=@$this->root['user_thumb_width']?@$this->root['user_thumb_width']:$this->thumb_width;
								$thumb_height=@$this->root['user_thumb_height']?@$this->root['user_thumb_height']:$this->thumb_height;	
				break;
				case 'Wechat':
								$thumb_width=@$this->root['wechat_thumb_width']?@$this->root['wechat_thumb_width']:$this->thumb_width;
								$thumb_height=@$this->root['wechat_thumb_height']?@$this->root['wechat_thumb_height']:$this->thumb_height;
				break;
				default:
								$thumb_width=$thumb_width?$thumb_width:$this->thumb_width;
								$thumb_height=$thumb_height?$thumb_height:$this->thumb_height;
				break;
			}
			if(!is_dir($uploads_dir.'/'.$classname.'/thumb/')) 
			{
				mkdir($uploads_dir.'/'.$classname.'/thumb/', 0777, true);
			}
			// 生成缩略图
			$img = Image::make($data_image)->resize($thumb_width,$thumb_height)->save($thumb_filename);
			
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
	****@AuThor : rubbish.boy@163.com
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
