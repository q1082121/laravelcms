<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :公共控制器
*******************************************/
namespace App\Http\Controllers\Api\V1;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use DB;
use Validator;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
use Redis;
use Cache;
use Carbon;
use Redirect;
// 导入 Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class PublicController extends Controller
{
	use Helpers;
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
		
	}


}
