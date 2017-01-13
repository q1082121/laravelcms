<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :收货地址
*******************************************/
namespace App\Http\Controllers\Api\V1\Xcx;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use DB;
use Cache;
use App\Http\Model\Xcxaddress;

class AddressController extends PublicController
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

						$count_condition['xcxuser_id']=$xcxuser['id'];
						$count_condition['status']=1;
						$count=Xcxaddress::where($count_condition)->count();
						
						$formdata=$param['formdata'];
						$formdata_hidden=$param['formdata_hidden'];
						$params = new Xcxaddress;
						$params->name 				=$formdata['name'];
						$params->mobile 			=$formdata['mobile'];
						$params->area_pid 			=$formdata_hidden['area_pid'];
						$params->area_pname 		=$formdata_hidden['area_pname'];
						$params->area_cid 			=$formdata_hidden['area_cid'];
						$params->area_cname 		=$formdata_hidden['area_cname'];
						$params->area_xid 			=$formdata_hidden['area_xid'];	
						$params->area_xname			=$formdata_hidden['area_xname'];
						$params->address			=$formdata['address'];
						$params->isdefault			=$count==0?1:0;
						$params->status				=1;								
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
						
						$list_condition['xcxuser_id']=$xcxuser['id'];
						$list_condition['status']=1;
						$list=Xcxaddress::where($list_condition)->orderBy('updated_at','desc')->get()->toArray();
						if($list)
						{
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
						$info=Xcxaddress::where($info_condition)->first()->toArray();
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
						$info=Xcxaddress::where($info_condition)->first()->toArray();
						if($info)
						{
							$formdata=$param['formdata'];
							$formdata_hidden=$param['formdata_hidden'];
							$params['name'] 			=$formdata['name'];
							$params['mobile'] 			=$formdata['mobile'];
							$params['area_pid']			=$formdata_hidden['area_pid'];
							$params['area_pname'] 		=$formdata_hidden['area_pname'];
							$params['area_cid'] 		=$formdata_hidden['area_cid'];
							$params['area_cname'] 		=$formdata_hidden['area_cname'];
							$params['area_xid'] 		=$formdata_hidden['area_xid'];	
							$params['area_xname']		=$formdata_hidden['area_xname'];
							$params['address']			=$formdata['address'];
							$params['updated_at'] 		=date('Y-m-d H:i:s');	
							 	 

							$updateres=DB::table('xcxaddresses')->where($info_condition)->update($params);
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
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :设置
	*******************************************/
	public function api_set(Request $request)  
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
						$id=@$actiondata['id'];

						$info_condition['xcxuser_id']=$xcxuser['id'];
						$info_condition['id']=$id;
						$info=Xcxaddress::where($info_condition)->first()->toArray();
						if($info)
						{
							
							if($info['isdefault']==0)
							{
								$allparams['isdefault'] 		=0;
								$allparams['updated_at'] 		=date('Y-m-d H:i:s');
								$all_condition['xcxuser_id']=$xcxuser['id'];
								DB::table('xcxaddresses')->where($all_condition)->update($allparams);
								
								$params['isdefault'] 		=1;
								$params['updated_at'] 		=date('Y-m-d H:i:s');
							}
							else
							{
								$params['isdefault'] 		=0;
								$params['updated_at'] 		=date('Y-m-d H:i:s');
							}	 	
							$updateres=DB::table('xcxaddresses')->where($info_condition)->update($params);
							if($updateres)
							{
								$msg_array['status']='1';
								$msg_array['info']=trans('api.message_set_success');
								$msg_array['curl']='';
								$msg_array['resource']="";
							}
							else
							{
								$msg_array['status']='0';
								$msg_array['info']=trans('api.message_set_failure');
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
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :默认数据
	*******************************************/
	public function api_default(Request $request)  
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
						$info_condition['isdefault']=1;
						$info=Xcxaddress::where($info_condition)->first();
						if($info)
						{
							$expresstemplate_condition['isdefault']=1;
							$expresstemplate_info=object_array(DB::table('expresstemplates')->where($expresstemplate_condition)->first());

							if($expresstemplate_info)
							{
								if($expresstemplate_info['ispostage'])
								{
									$info['wayname']="平邮";
								}
								else if($expresstemplate_info['isexpress'])
								{
									$info['wayname']="快递";
								}
								else if($expresstemplate_info['isems'])
								{
									$info['wayname']="EMS";
								}
								else
								{
									$info['wayname']="未设置货运方式";
								}

								$expressvalue_condition['status']=1;
								$expressvalue_info=object_array(DB::table('expressvalues')->where($expressvalue_condition)->where('area_items','like',"%-".$info['area_pid'].'-%')->first());
								if($expressvalue_info)
								{
									$info['price']=$expressvalue_info['price'];
									$info['title']=$expressvalue_info['name'];
								}
								else
								{
									if($expresstemplate_info['ispostage'])
									{
										$info['price']=$expresstemplate_info['price_postage'];
										$info['title']="默认平邮";
									}
									else if($expresstemplate_info['isexpress'])
									{
										$info['price']=$expresstemplate_info['price_express'];
										$info['title']="默认快递";
									}
									else if($expresstemplate_info['isems'])
									{
										$info['price']=$expresstemplate_info['price_ems'];
										$info['title']="默认EMS";
									}
									else
									{
										$info['price']="未设置运费模板";
										$info['title']="未设置运费模板1";
									}
								}

							}
							else
							{
								$info['price']="未设置运费模板";
								$info['wayname']="未设置货运方式";
								$info['title']="未设置运费模板3";
							}

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
}
