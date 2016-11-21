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
	protected $roleinfo;
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
            $this->user=$user=Auth::guard($guard)->user();
            $cache_userinfo='userinfo_'.$user['id'];
			$this->userinfo=$userinfo=action_cache($user['id'],'userinfo');
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
				//获取未读信件
				$condition_index['email_to']=$this->user['email'];
				$condition_index['istrash_to']=0;
				$condition_index['isdel_to']=0;
				$condition_index['status']=0;
				$letters_count=DB::table('letters')->where($condition_index)->count();
				$letters_list=DB::table('letters')->where($condition_index)->take(5)->get();
				$this->website['letters_count']=$letters_count?$letters_count:0;
				$this->website['letters_list']=json_encode(object_array($letters_list));
				
				//用户组信息
				$cache_userrole='userrole_'.$user['id'];
				$this->roleinfo=$roleinfo=action_cache($user['id'],'userrole');
				$this->website['website_roleinfo']=$this->roleinfo;
			}
        }
		else
		{	
				//alert('/user/login',trans('admin.message_userrole_login'));
				Redirect::to('/user/login')->send();
		}
		
	}


}
