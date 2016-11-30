<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :用户接口
*******************************************/
namespace App\Http\Controllers\Api\V1\Xcx;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Cache;
use App\Http\Model\Xcxuser;

class UserController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :信息接口
	*******************************************/
	public function api_userinfo(Request $request)  
	{
		$getcontent=$request->getContent();
		$param=json_decode($getcontent,true);
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
					
					$xcxuser_array['nickName']=$xcxuser['nickname'];
					$xcxuser_array['nickname_encode']=$xcxuser['nickname_encode'];
					$xcxuser_array['gender']=$xcxuser['gender'];
					$xcxuser_array['city']=$xcxuser['city'];
					$xcxuser_array['province']=$xcxuser['province'];
					$xcxuser_array['country']=$xcxuser['country'];
					$xcxuser_array['avatarUrl']=$xcxuser['avatarurl'];
					$xcxuser_array['score']=$xcxuser['score'];
					$xcxuser_array['money']=$xcxuser['money'];

					$msg_array['status']='1';
					$msg_array['info']=trans('admin.message_get_success');
					$msg_array['curl']='';
					$msg_array['resource']=$xcxuser_array;
				}
				else
				{
					$msg_array['status']='0';
					$msg_array['info']=trans('admin.message_get_failure');
					$msg_array['curl']='';
					$msg_array['resource']="3";	
				}
			}
			else
			{
				$msg_array['status']='0';
				$msg_array['info']=trans('admin.message_get_failure');
				$msg_array['curl']='';
				$msg_array['resource']="2";	
			}
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_get_empty');
			$msg_array['curl']='';
			$msg_array['resource']="1";
		}
		
        return $msg_array;
	}
	
}
