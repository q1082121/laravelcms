<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :获取当前位置接口
*******************************************/
namespace App\Http\Controllers\Api\V1\Xcx;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use DB;
use Cache;

class GetlocationController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :位置信息接口
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
						$formdata=$param['formdata'];
						$mapurl="http://apis.map.qq.com/ws/geocoder/v1/?location=".$formdata['latitude'].",".$formdata['longitude']."&key=".$xcxmp['mapkey']."&coord_type=5";
						$res=http_curl_request($mapurl);
						$res_arr=json_decode($res,true);
						if($res_arr['status']==0)
						{
							$province=$res_arr['result']['ad_info']['province'];
							$city=$res_arr['result']['ad_info']['city'];
							$district=$res_arr['result']['ad_info']['district'];
							$alias=mb_substr($province,0,2);
							$addata['province']=$province;
							$addata['city']=$city;
							$addata['district']=$district;
							$addata['alias']=$alias;

							$district_condition['alias']=$alias;
							$district_condition['level']=1;
							$district_info=object_array(DB::table('districts')->where($district_condition)->first());

							$expresstemplate_condition['isdefault']=1;
							$expresstemplate_info=object_array(DB::table('expresstemplates')->where($expresstemplate_condition)->first());

							if($expresstemplate_info)
							{
								if($district_info)
								{
									$expressvalue_condition['status']=1;
									$expressvalue_info=object_array(DB::table('expressvalues')->where($expressvalue_condition)->where('area_items','like',"%-".$district_info['id'].'-%')->first());
									if($expressvalue_info)
									{
										$addata['price']=$expressvalue_info['price'];
										$addata['name']=$expressvalue_info['name'];
									}
									else
									{
										if($expresstemplate_info['ispostage'])
										{
											$addata['price']=$expresstemplate_info['price_postage'];
											$addata['name']="默认平邮";
										}
										else if($expresstemplate_info['isexpress'])
										{
											$addata['price']=$expresstemplate_info['price_express'];
											$addata['name']="默认快递";
										}
										else if($expresstemplate_info['isems'])
										{
											$addata['price']=$expresstemplate_info['price_ems'];
											$addata['name']="默认快递";
										}
										else
										{
											$addata['price']="";
											$addata['name']="未设置运费模板1";
										}
									}
								}
								else
								{
									$expressvalue_condition['status']=1;
									$expressvalue_info=object_array(DB::table('expressvalues')->where($expressvalue_condition)->where('area_items','like',"%-36-%")->first());
									if($expressvalue_info)
									{
										$addata['price']=$expressvalue_info['price'];
										$addata['name']=$expressvalue_info['name'];
									}
									else
									{
										if($expresstemplate_info['ispostage'])
										{
											$addata['price']=$expresstemplate_info['price_postage'];
											$addata['name']="默认平邮";
										}
										else if($expresstemplate_info['isexpress'])
										{
											$addata['price']=$expresstemplate_info['price_express'];
											$addata['name']="默认快递";
										}
										else if($expresstemplate_info['isems'])
										{
											$addata['price']=$expresstemplate_info['price_ems'];
											$addata['name']="默认快递";
										}
										else
										{
											$addata['price']="";
											$addata['name']="未设置运费模板2";
										}
									}
								}
							}
							else
							{
								$addata['price']="";
								$addata['name']="未设置运费模板3";
							}


							$msg_array['status']='1';
							$msg_array['info']=trans('api.message_get_success');
							$msg_array['curl']='';
							$msg_array['resource']=$addata;
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
