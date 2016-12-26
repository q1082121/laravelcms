<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :省市区地区
*******************************************/
namespace App\Http\Controllers\Api\V1\Xcx;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use DB;
use Cache;
use App\Http\Model\District;

class DistrictController extends PublicController
{
    //
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表接口
	*******************************************/
	public function api_area(Request $request)  
	{
		$condition['parentid']=$request->get('parentid')?$request->get('parentid'):0;
        $condition['level']=$request->get('level')?$request->get('level'):1;
		$list=object_array(DB::table('districts')->where($condition)->get());
		if($list)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_get_success');
			$msg_array['curl']='';
			$msg_array['resource']=$list;
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_get_empty');
			$msg_array['curl']='';
			$msg_array['resource']="";
		}
        return $msg_array;
	}

}
