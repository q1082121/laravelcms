<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :公共控制器
*******************************************/
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//验证
use Illuminate\Support\Facades\Auth;
use DB;
//引用对应的命名空间 debug 插件
use Validator;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
use Redis;
use Cache;
use Carbon;
use App\Http\Model\User;
use Redirect;
use Entrust;
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
		$root['systitle']=@$root['systitle']?@$root['systitle']:"LaravelCms";
		$root['syskeywords']=@$root['syskeywords']?@$root['syskeywords']:"";
		$root['sysdescription']=@$root['sysdescription']?@$root['sysdescription']:"";
		$this->website['root']=$this->root=@$root;

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
			if(Entrust::hasRole(['admin','areaadmin','subareaadmin','user_1']) == false )
			{
				alert('/',trans('admin.message_userrole_failure'));
			}
			else
			{
				
			}
        }
		else
		{	
				alert('/user/login',trans('admin.message_userrole_login'));
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
			case "User":

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
				case 'User':
								$thumb_width=@$this->root['user_thumb_width']?@$this->root['user_thumb_width']:$this->thumb_width;
								$thumb_height=@$this->root['user_thumb_height']?@$this->root['user_thumb_height']:$this->thumb_height;	
				break;
				default:
								$thumb_width=@$thumb_width?@$thumb_width:$this->thumb_width;
								$thumb_height=@$thumb_height?@$thumb_height:$this->thumb_height;
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
		else
		{
			$result=0;
		}

		return $result;
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :获取经验值操作
	*******************************************/
	public function FunctionName($params_experience)
	{
		DB::beginTransaction();
		try
		{ 
				$result_experience=in_experience($params_experience);
				if($result_experience)
				{
					$userinfos_condition['user_id']=$params_experience['user_id'];
					DB::table('userinfos')->where($userinfos_condition)->increment('experience', $experience);
					
					DB::commit();
				}
				else
				{
					DB::rollBack();
				}

		}
		catch (\Exception $e) 
		{ 
			DB::rollBack(); 
		}

	}

}
