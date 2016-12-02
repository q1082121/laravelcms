<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :登录接口
*******************************************/
namespace App\Http\Controllers\Api\V1\Xcx;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use DB;
use Cache;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Model\Xcxuser;

class LoginController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :登录接口
	*******************************************/
	public function api_login(Request $request)  
	{
		$request_token=$this->request_token;
		if($request_token['status']==1)
		{
			$param=$request_token['request'];
			$xcxmp=$request_token['data'];
			$appid=$xcxmp['appid'];
			$appsecret=$xcxmp['appsecret'];
			$code=@$param['code'];
			if(@$code)
			{
				/**/
				$URL="https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$appsecret."&js_code=".$code."&grant_type=authorization_code";
				$res=http_curl_request($URL);
				$result=json_decode($res,true);
				if(@$result['errcode']=='40029')
				{
					$msg_array['status']='0';
					$msg_array['info']=trans('api.message_get_failure');
					$msg_array['curl']='';
					$msg_array['resource']=$result['errcode'];	
				}
				else
				{	
					$sessionKey = $result['session_key'];
					$iv=$param['iv'];
					$encryptedData=$param['encryptedData'];

					//服务器存储newsession_id
					$str=$sessionKey.$result['openid'];
					$newsession_id=Hashids::encode(date('Ymd').rand(10000000,99999999));
					Cache::store('redis')->put($newsession_id, $str, 86400);//29天有效2505600 
					
					$res=$this->decode_encryptedData($appid,$sessionKey,$encryptedData, $iv);
					if($res['status']==1)
					{
						$array_data=$res['data'];
						$openid=$array_data['openId'];
						$unionid=@$array_data['unionId']?@$array_data['unionId']:"";
						$msg_array['data']['nickName']=$array_data['nickName'];
						$msg_array['data']['gender']=$array_data['gender'];
						$msg_array['data']['city']=$array_data['city'];
						$msg_array['data']['province']=$array_data['province'];
						$msg_array['data']['country']=$array_data['country'];
						$msg_array['data']['avatarUrl']=$array_data['avatarUrl'];
						//$msg_array['data']=$array_data;
						
						$condition['openid']=$openid;
						$condition['unionid']=$unionid;
						$xcxuser=object_array(DB::table('xcxusers')->where($condition)->first());
						if($xcxuser)
						{
							$params = Xcxuser::find($xcxuser['id']);
							$params->nickname 			= $array_data['nickName'];
							$params->nickname_encode	= base64_encode($array_data['nickName']);
							$params->gender				= $array_data['gender'];
							$params->province			= $array_data['province'];
							$params->city				= $array_data['city'];
							$params->country			= $array_data['country'];
							$params->avatarurl			= $array_data['avatarUrl'];
							$params->save();
						}
						else
						{
							$params = new Xcxuser;
							$params->openid 			= $openid;
							$params->unionid 			= $unionid;
							$params->nickname 			= $array_data['nickName'];
							$params->nickname_encode	= base64_encode($array_data['nickName']);
							$params->gender				= $array_data['gender'];
							$params->province			= $array_data['province'];
							$params->city				= $array_data['city'];
							$params->country			= $array_data['country'];
							$params->avatarurl			= $array_data['avatarUrl'];
							$params->status				= 1;
							$params->save();
						}

					}
					else
					{
						$msg_array['data']=$errCode;
					}
					$msg_array['status']='1';
					$msg_array['info']=trans('api.message_get_success');
					$msg_array['curl']='';
					$msg_array['resource']=$newsession_id;

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
