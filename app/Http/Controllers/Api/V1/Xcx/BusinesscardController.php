<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :名片
*******************************************/
namespace App\Http\Controllers\Api\V1\Xcx;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use DB;
use Cache;
use App\Http\Model\Xcxbusinesscard;

class BusinesscardController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加接口
	*******************************************/
	public function api_add(Request $request)  
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
						$fromdata=$param['fromdata'];
						$params = new Xcxbusinesscard;
						$params->name 				=$fromdata['name'];
						$params->mobile 			=$fromdata['mobile'];
						$params->company 			=$fromdata['company'];
						$params->address 			=$fromdata['address'];						
						$params->xcxuser_id 		=$xcxuser['id'];

						if($params->save())
						{
							$msg_array['status']='1';
							$msg_array['info']=trans('api.message_add_success');
							$msg_array['curl']='';
							$msg_array['resource']="";
						}
						else
						{
							$msg_array['status']='0';
							$msg_array['info']=trans('api.message_add_failure');
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
