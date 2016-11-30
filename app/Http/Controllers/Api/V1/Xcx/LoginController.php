<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :小程序
*******************************************/
namespace App\Http\Controllers\Api\V1\Xcx;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Cache;
use Vinkla\Hashids\Facades\Hashids;
use App\Common\lib\aes\WXBizDataCrypt;
use App\Common\lib\aes\PKCS7Encoder;
use App\Common\lib\aes\ErrorCode;
class LoginController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表接口
	*******************************************/
	public function api_login(Request $request)  
	{
		$getcontent=$request->getContent();
		$param=json_decode($getcontent,true);
		$code=@$param['code'];
		if(@$code)
		{
			/**/
			$appid="wx5175b09bb5916400";
			$AppSecret="efab8a9384616559ab3702cf97552850";
			$URL="https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$AppSecret."&js_code=".$code."&grant_type=authorization_code";
			$res=http_curl_request($URL);
			$result=json_decode($res,true);
			if(@$result['errcode']=='40029')
			{
				$msg_array['status']='0';
				$msg_array['info']=trans('admin.message_get_failure');
				$msg_array['curl']='';
				$msg_array['resource']=$result['errcode'];	
			}
			else
			{	
				$sessionKey = $result['session_key'];
				$iv=$param['iv'];
				$str=$sessionKey.$result['openid'];
				$newsession_id=Hashids::encode(date('Ymd').rand(10000000,99999999));
				Cache::store('redis')->put($newsession_id, $str, 3600);//29天有效2505600
				$encryptedData=$param['encryptedData'];
				
				$wxCrypt = new WXBizDataCrypt();
				$wxCrypt->WXBizDataCrypt($appid,$sessionKey);
				$errCode = $wxCrypt->decryptData($encryptedData, $iv, $data );
				if ($errCode == 0) 
				{
					$array_data=json_decode($data,true);
					$msg_array['data']['nickName']=$array_data['nickName'];
					$msg_array['data']['gender']=$array_data['gender'];
					$msg_array['data']['city']=$array_data['city'];
					$msg_array['data']['province']=$array_data['province'];
					$msg_array['data']['country']=$array_data['country'];
					$msg_array['data']['avatarUrl']=$array_data['avatarUrl'];
					//$msg_array['data']=$array_data;
				} 
				else 
				{
					$msg_array['data']=$errCode;
				}

				$msg_array['status']='1';
				$msg_array['info']=trans('admin.message_get_success');
				$msg_array['curl']='';
				$msg_array['resource']=$newsession_id;
				$msg_array['session_key']=$sessionKey;
				$msg_array['param']=$param;
			}
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_get_empty');
			$msg_array['curl']='';
			$msg_array['resource']="";
		}
		
        return $msg_array;
	}
}
