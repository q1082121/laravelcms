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
							if($list)
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
								$msg_array['resource']="";
							}
						}
						else
						{
							$search_condition['status']=1;
							$list=Product::where($search_condition)->orderBy('updated_at','desc')->paginate($this->pagesize);
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
