<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :产品
*******************************************/
namespace App\Http\Controllers\Api\V1\Xcx;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use DB;
use Cache;
use App\Http\Model\Product;

class ProductController extends PublicController
{
	
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
							$search_condition['status']=1;
							$list=Product::where($search_condition)->where('title','like',"%".$keyword.'%')->orderBy('updated_at','desc')->paginate($this->pagesize);
							$list->appends(['keyword' => $keyword])->links();
							if($list && $list->total()>0)
							{
								//分页传参数
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
								$msg_array['resource']=$list;
							}
						}
						else
						{
							$search_condition['status']=1;
							$list=Product::where($search_condition)->orderBy('updated_at','desc')->paginate($this->pagesize);
							if($list && $list->total()>0)
							{
								foreach($list as $key=>$val)
								{
									$subcondition['product_id']=$val['id'];
									$price=DB::table('productattributes')->where($subcondition)->min('price');
									$maxprice=DB::table('productattributes')->where($subcondition)->max('price');
									$list[$key]['price']=$price?$price:"暂无定价";
									$list[$key]['maxprice']=$maxprice==$price?"":$maxprice;
									$list[$key]['pricegroup']=$price?($maxprice==$price?$price:$price.' - '.$maxprice):"暂无定价";
								}

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
								$msg_array['resource']=$list;
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
						$info_condition['status']=1;
						$info_condition['id']=@$param['id'];
						$info=Product::where($info_condition)->first()->toArray();
						if($info)
						{
							$info['content']=str_replace("/uploads/", $this->domainName."/uploads/", $info['content']);
							$subcondition['product_id']=$info['id'];
							$price=DB::table('productattributes')->where($subcondition)->min('price');
							$maxprice=DB::table('productattributes')->where($subcondition)->max('price');
							$info['price']=$price?$price:"暂无定价";
							$info['maxprice']=$maxprice==$price?"":$maxprice;
							$info['pricegroup']=$price?($maxprice==$price?$price:$price.' - '.$maxprice):"暂无定价";
							$info['amount']=DB::table('productattributes')->where($subcondition)->sum('amount');
							$info['selleds']=DB::table('productattributes')->where($subcondition)->sum('selleds');
							$info['total_amount']=$info['amount'] - $info['selleds'];
							$info['sublist']=$sublist=Product::find($info['id'])->hasManyProductattributes()->orderby('orderid','asc')->get()->toArray();
							
							/*
							$cache_classproduct= Cache::store('file')->get('classproduct');
							$topinfo = object_array(DB::table('products')->whereId($info['id'])->first());
							$bclassid=$cache_classproduct[$topinfo['classid']]['topid']==0?$cache_classproduct[$topinfo['classid']]['id']:$cache_classproduct[$topinfo['classid']]['topid'];
							$attributegroup_list=object_array(DB::table('attributegroups')->where('groupitems', 'like', '%-'.$bclassid.'-%')->orderby('orderid','asc')->get());
							$info['attributegroup_list']=$attributegroup_list;
							*/

							if($sublist)
							{
								foreach($sublist as $key=>$val)
								{
									$subpavcondition['product_id']=$info['id'];
									$subpavcondition['productattribute_id']=$val['id'];
									$info['sublist'][$key]['subpavlist']=$subpavlist=object_array(DB::table('productattributegroupvalues')->where($subpavcondition)->get());
									if($subpavlist)
									{
										foreach($subpavlist as $subkey=>$subval)
										{	
											$groupcondition['name']=$subval['keyname'];
											$grouptype=object_array(DB::table('attributegroups')->where($groupcondition)->first());
											if($grouptype['type']=="radio")
											{
												$valuecondition['id']=str_replace("-",'',$subval['keyval']);
												$valuename=object_array(DB::table('attributevalues')->where($valuecondition)->first());
												$keydisplay_name=$valuename['name'];
												$keyval=$valuename['val'];
											}
											else if($grouptype['type']=="text")
											{
												$keydisplay_name=$subval['keyval'];
												$keyval="";
											}
											$info['sublist'][$key]['subpavlist'][$subkey]['keyname']=$keydisplay_name;
											$info['sublist'][$key]['subpavlist'][$subkey]['keyval']=$keyval;
										}
									}
									
								}
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
