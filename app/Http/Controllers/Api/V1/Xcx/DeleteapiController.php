<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :删除控制器
*******************************************/
namespace App\Http\Controllers\Api\V1\Xcx;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use DB;
use Cache;
use App\Http\Model\Xcxbusinesscard;

class DeleteapiController extends PublicController
{
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :删除接口
	*******************************************/
	public function api_delete(Request $request)  
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
						$actiondata=@$param['actiondata'];
						$modelname=@$actiondata['model'];
						$id=@$actiondata['id'];
						switch($modelname)
						{
							case 'businesscard':
									$info=$this->delete_action('xcxbusinesscards',$id);
									if($info)
									{
										$msg_array['status']='1';
										$msg_array['info']=trans('api.message_del_success');
										$msg_array['curl']='';
										$msg_array['resource']='';
									}
									else
									{
										
										$msg_array['status']='0';
										$msg_array['info']=trans('api.message_del_failure');
										$msg_array['curl']='';
										$msg_array['resource']='5';
										
									}
							break;
							case 'shoppingcart':
									$info=$this->delete_action('xcxshoppingcarts',$id);
									if($info)
									{
										$msg_array['status']='1';
										$msg_array['info']=trans('api.message_del_success');
										$msg_array['curl']='';
										$msg_array['resource']='';
									}
									else
									{
										
										$msg_array['status']='0';
										$msg_array['info']=trans('api.message_del_failure');
										$msg_array['curl']='';
										$msg_array['resource']='5';
										
									}
							break;
							case 'address':
									$info=$this->delete_action('xcxaddresses',$id);
									if($info)
									{
										$msg_array['status']='1';
										$msg_array['info']=trans('api.message_del_success');
										$msg_array['curl']='';
										$msg_array['resource']='';
									}
									else
									{
										
										$msg_array['status']='0';
										$msg_array['info']=trans('api.message_del_failure');
										$msg_array['curl']='';
										$msg_array['resource']='5';
										
									}
							break;
							default :
									$msg_array['status']='0';
									$msg_array['info']=trans('api.message_request_failure');
									$msg_array['curl']='';
									$msg_array['resource']="4";
							break;
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
	****Title :删除操作
	*******************************************/
	public function delete_action($tablename,$id,$filed='id') 
	{
		$condition[$filed]=$id;
		$info=DB::table($tablename)->where($condition)->delete();//返回1;
		return $info;
	} 
}
