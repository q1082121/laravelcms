<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :公共控制器
*******************************************/
namespace App\Http\Controllers\Api\V1\Xcx;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
use Redis;
use Cache;
use Carbon;
use Redirect;
use Intervention\Image\ImageManagerStatic as Image;
use App\Common\lib\aes\WXBizDataCrypt;
use App\Common\lib\aes\PKCS7Encoder;
use App\Common\lib\aes\ErrorCode;

class PublicController extends Controller
{
	use Helpers;
	protected $website;
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :后台首页
	*******************************************/
	public function __construct(Request $request)
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
		
		$this->domainName="https://".env('API_DOMAIN', '');
		$getcontent=$request->getContent();
		$param=json_decode($getcontent,true);
		$this->request_token=$this->request_token($param);

	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :请求token处理
	*******************************************/
	public function request_token($param)
	{
		$token=@$param['token'];
		if(@$token)
		{
			$condition['token']=$token;
			$xcxmp=object_array(DB::table('xcxmps')->where($condition)->first());
			if($xcxmp)
			{
				$request_token['status']=1;
				$request_token['data']=$xcxmp;
				$request_token['request']=$param;
				$request_token['info']=trans('api.message_request_success');
			}
			else
			{
				$request_token['status']=0;
				$request_token['data']="";
				$request_token['info']=trans('api.message_token_failure');
			}
		}
		else
		{
			$request_token['status']=0;
			$request_token['data']="";
			$request_token['info']=trans('api.message_token_empty');
		}
		return $request_token;
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :数据解密
	*******************************************/
	public function decode_encryptedData($appid,$sessionKey,$encryptedData,$iv)
	{
		$wxCrypt = new WXBizDataCrypt();
		$wxCrypt->WXBizDataCrypt($appid,$sessionKey);
		$errCode = $wxCrypt->decryptData($encryptedData, $iv, $data );
		if ($errCode == 0) 
		{
			$res['status']=1;
			$res['data']=json_decode($data,true);
		}
		else
		{
			$res['status']=0;
			$res['data']=$errCode;
		}
		return $res;
	}

}
