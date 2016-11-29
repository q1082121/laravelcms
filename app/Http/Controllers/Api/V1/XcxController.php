<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :小程序
*******************************************/
namespace App\Http\Controllers\Api\V1;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Cache;
use Vinkla\Hashids\Facades\Hashids;
use App\Common\lib\WXBizDataCrypt;

class XcxController extends PublicController
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
			$APPID="wx5175b09bb5916400";
			$AppSecret="efab8a9384616559ab3702cf97552850";
			$URL="https://api.weixin.qq.com/sns/jscode2session?appid=".$APPID."&secret=".$AppSecret."&js_code=".$code."&grant_type=authorization_code";
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
				$str=$result['session_key'].$result['openid'];
				$newsession_id=Hashids::encode(date('Ymd').rand(10000000,99999999));
				Cache::store('redis')->put($newsession_id, $str, 3600);//29天有效2505600
				$encryptedData=$param['encryptedData'];
				$iv=$param['iv'];

				$wxCrypt = new WXBizDataCrypt();
				$wxCrypt->WXBizDataCrypt($APPID,$result['session_key']);
				$errCode = $wxCrypt->decryptData($encryptedData, $iv, $data );
				if ($errCode == 0) 
				{
					$msg_array['data']=$data;
				} 
				else 
				{
					$msg_array['data']=$errCode;
				}

				$msg_array['status']='1';
				$msg_array['info']=trans('admin.message_get_success');
				$msg_array['curl']='';
				$msg_array['resource']=$newsession_id;
				$msg_array['old']=$param;
				$msg_array['result']=strlen($result['session_key']);
				
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
