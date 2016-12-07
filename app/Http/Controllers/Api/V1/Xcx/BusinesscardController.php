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
use Overtrue\Pinyin\Pinyin;

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
						$formdata=$param['formdata'];
						$params = new Xcxbusinesscard;
						$params->name 				=$formdata['name'];
						$params->initials 			=substr(strtoupper(pinyin_abbr($formdata['name'])),0,1);
						$params->pinyin 			=$formdata['name']?pinyin_sentence($formdata['name']):"";
						$params->mobile 			=$formdata['mobile'];
						$params->qq 				=$formdata['qq'];
						$params->email 				=$formdata['email'];
						$params->fax 				=$formdata['fax'];
						$params->company 			=$formdata['company'];
						$params->address 			=$formdata['address'];						
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
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表接口
	*******************************************/
	public function api_list(Request $request)  
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
						$keyword=@$param['search_keyword'];
						if($keyword)
						{
							$initials_list_condition['xcxuser_id']=$xcxuser['id'];
							$initials_list=object_array(DB::table('xcxbusinesscards')->where($initials_list_condition)->where('name','like',"%".$keyword.'%')->orderBy('initials','asc')->distinct()->pluck('initials'));
							if($initials_list)
							{
								$list="";
								sort($initials_list);
								//$initials_list=array_unique($initials_list);
								foreach($initials_list as $key=>$val)
								{
									$initials_list_condition['initials']=$val;
									$list[$key]['key']=$val;
									$list[$key]['data']=Xcxbusinesscard::where($initials_list_condition)->where('name','like',"%".$keyword.'%')->orderBy('name')->get()->toArray();
								}
								ksort($list);
								$msg_array['status']='1';
								$msg_array['info']=trans('api.message_get_success');
								$msg_array['curl']='';
								$msg_array['resource']=$list;
							}
							else
							{
								$msg_array['status']='1';
								$msg_array['info']=trans('api.message_get_empty');
								$msg_array['curl']='';
								$msg_array['resource']="";
							}
						}
						else
						{
							$initials_list_condition['xcxuser_id']=$xcxuser['id'];
							$initials_list=object_array(DB::table('xcxbusinesscards')->where($initials_list_condition)->orderBy('initials','asc')->distinct()->pluck('initials'));
							if($initials_list)
							{
								$list="";
								sort($initials_list);
								//$initials_list=array_unique($initials_list);
								foreach($initials_list as $key=>$val)
								{
									$initials_list_condition['initials']=$val;
									$list[$key]['key']=$val;
									$list[$key]['data']=Xcxbusinesscard::where($initials_list_condition)->orderBy('name')->get()->toArray();
								}
								ksort($list);

								$msg_array['status']='1';
								$msg_array['info']=trans('api.message_get_success');
								$msg_array['curl']='';
								$msg_array['resource']=$list;
								
							}
							else
							{
								$msg_array['status']='1';
								$msg_array['info']=trans('api.message_get_empty');
								$msg_array['curl']='';
								$msg_array['resource']="";
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
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :详情接口
	*******************************************/
	public function api_info(Request $request)  
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
						$info_condition['xcxuser_id']=$xcxuser['id'];
						$info_condition['id']=@$param['id'];
						$info=Xcxbusinesscard::where($info_condition)->first()->toArray();
						if($info)
						{
							$msg_array['status']='1';
							$msg_array['info']=trans('api.message_get_success');
							$msg_array['curl']='';
							$msg_array['resource']=$info;
						}
						else
						{
							$msg_array['status']='1';
							$msg_array['info']=trans('api.message_get_empty');
							$msg_array['curl']='';
							$msg_array['resource']="";
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
	****Title :编辑接口
	*******************************************/
	public function api_edit(Request $request)  
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
						$formdataid=@$param['formdataid'];
						$info_condition['xcxuser_id']=$xcxuser['id'];
						$info_condition['id']=$formdataid;
						$info=Xcxbusinesscard::where($info_condition)->first()->toArray();
						if($info)
						{
							$formdata=$param['formdata'];
							$params['name'] 				=$formdata['name'];
							$params['initials'] 			=substr(strtoupper(pinyin_abbr($formdata['name'])),0,1);
							$params['pinyin']				=$formdata['name']?pinyin_sentence($formdata['name']):"";
							$params['mobile'] 				=$formdata['mobile'];
							$params['qq']					=$formdata['qq'];
							$params['email']				=$formdata['email'];
							$params['fax']					=$formdata['fax'];
							$params['company']				=$formdata['company'];
							$params['address'] 				=$formdata['address'];
							$params['updated_at'] 			=date('Y-m-d H:i:s');	
							 	 

							$updateres=DB::table('xcxbusinesscards')->where($info_condition)->update($params);
							if($updateres)
							{
								$msg_array['status']='1';
								$msg_array['info']=trans('api.message_update_success');
								$msg_array['curl']='';
								$msg_array['resource']="";
							}
							else
							{
								$msg_array['status']='0';
								$msg_array['info']=trans('api.message_update_failure');
								$msg_array['curl']='';
								$msg_array['resource']="5";
							}
						}
						else
						{
							$msg_array['status']='0';
							$msg_array['info']=trans('api.message_request_failure');
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
