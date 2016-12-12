<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :积分接口
*******************************************/
namespace App\Http\Controllers\Api\V1\Xcx;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use DB;
use Cache;
use App\Http\Model\Xcxscore;

class ScoreController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :获取每天是否签到
	*******************************************/
	public function api_is_check_in(Request $request)  
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
						$startTime = date('Y-m-d'.' 00:00:00',time());
    					$endTime   = date('Y-m-d'.' 23:59:59',time());
						$score_condition['xcxuser_id']=$xcxuser['id'];
						$score_condition['type']=1;
						$info=object_array(DB::table('xcxscores')->where($score_condition)->whereBetween('created_at', [$startTime, $endTime])->count());
						if($info==1)
						{
							$msg_array['status']='1';
							$msg_array['info']=trans('api.message_check_in_exit');
							$msg_array['curl']='';
							$msg_array['resource']=$info;	
						}
						else
						{
							$msg_array['status']='1';
							$msg_array['info']=trans('api.message_check_in_not');
							$msg_array['curl']='';
							$msg_array['resource']=$info;
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
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :签到接口
	*******************************************/
	public function api_check_in(Request $request)  
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
						$startTime = date('Y-m-d'.' 00:00:00',time());
    					$endTime   = date('Y-m-d'.' 23:59:59',time());
						$score_condition['xcxuser_id']=$xcxuser['id'];
						$score_condition['type']=1;
						$info=object_array(DB::table('xcxscores')->where($score_condition)->whereBetween('created_at', [$startTime, $endTime])->count());
						if($info==1)
						{
							$msg_array['status']='1';
							$msg_array['info']=trans('api.message_check_in_exit');
							$msg_array['curl']='';
							$msg_array['resource']="4";	
						}
						else
						{
							$score=1;
							$scoretpl = trans('api.score_action_info');
							// 带有替换信息的上下文数组，键名为占位符名称，键值为替换值。
							$score_context = interpolate($scoretpl, array('nickname' => $xcxuser['nickname'],'score'=>$score));
							
							$params_score['type']=1;
							$params_score['val']=$score;
							$params_score['info']=$score_context;
							$params_score['tablename']="";
							$params_score['keyid']=0;
							$params_score['xcxuser_id']=$xcxuser['id'];

							$result_score=action_xcxscore_check_in($params_score);
							if($result_score)
							{
								$xcxuser=object_array(DB::table('xcxusers')->where($condition)->first());

								$xcxuser_array=action_xcxuser_info($xcxuser);

								$msg_array['status']='1';
								$msg_array['info']=trans('api.message_check_in_success');
								$msg_array['curl']='';
								$msg_array['resource']=$xcxuser_array;
							}
							else
							{
								$msg_array['status']='0';
								$msg_array['info']=trans('api.message_check_in_failure');
								$msg_array['curl']='';
								$msg_array['resource']="4";	
							}

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
