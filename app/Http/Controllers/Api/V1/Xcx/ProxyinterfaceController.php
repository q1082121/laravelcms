<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :代理接口
*******************************************/
namespace App\Http\Controllers\Api\V1\Xcx;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use DB;
use Cache;

class ProxyinterfaceController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :抓取转发接口
	*******************************************/
	public function api_back(Request $request)  
	{
		$request_token=$this->request_token;
		if($request_token['status']==1)
		{
			$param=$request_token['request'];
			$xcxmp=$request_token['data'];
			$appid=$xcxmp['appid'];
			$appsecret=$xcxmp['appsecret'];
			$session_id=@$param['session_id'];
			if(@$session_id)
			{
				$session_openid=Cache::store('redis')->get($session_id);
				if(@$session_openid)
				{
					$openid=substr($session_openid, -28);
					$condition['openid']=$openid;
					$xcxuser=object_array(DB::table('xcxusers')->where($condition)->first());
					if($xcxuser)
					{
						$url=@$param['api_url'];
						$url_param=@$param['api_data'];
						/*
						if($url_param)
						{
							$quesarray="";
							$quesdatalist=explode("&",$url_param);
							foreach($quesdatalist as $key=>$val)
							{
								$quesdata=explode("=",$val);
								dump($quesdata);
								@$quesarray[$quesdata[0]]=$quesdata[1];
							}
						}
						$res=http_curl_request($url,$url_param);
						*/
						$res=http_curl_request($url."?".$url_param);
						
						if($res)
						{
							$msg_array=$res;
						}
						else
						{
							$msg_array['status']='0';
							$msg_array['info']=trans('api.message_get_failure');
							$msg_array['curl']='';
							$msg_array['resource']="4";	
						}
					}
					else
					{
						$msg_array['status']='0';
						$msg_array['info']=trans('api.message_sessionid_failure');
						$msg_array['curl']='';
						$msg_array['resource']="3";	
					}
				}
				else
				{
					$msg_array['status']='0';
					$msg_array['info']=trans('api.message_sessionid_failure');
					$msg_array['curl']='';
					$msg_array['resource']="2";	
				}
			}
			else
			{
				$msg_array['status']='0';
				$msg_array['info']=trans('api.message_get_empty');
				$msg_array['curl']='';
				$msg_array['resource']="1";
			}
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=$request_token['info'];
			$msg_array['curl']='';
			$msg_array['resource']="0";
		}
		
        return $msg_array;
	}
}
