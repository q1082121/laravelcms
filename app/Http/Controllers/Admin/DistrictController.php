<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :省市区地区
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//使用Class模型
use App\Http\Model\District;
use DB;
//使用URL生成地址
use URL;
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
		switch($condition['level'])
		{
			case 1:
					$list[]=array('id'=>0,'name'=>trans('admin.option_select_p'),'alias'=>trans('admin.option_select_p'));
			break;
			case 2:
					$list[]=array('id'=>0,'name'=>trans('admin.option_select_c'),'alias'=>trans('admin.option_select_c'));
			break;
			case 3:
					$list[]=array('id'=>0,'name'=>trans('admin.option_select_x'),'alias'=>trans('admin.option_select_x'));
			break;
		}
		$datalist=DB::table('districts')->where($condition)->get();
		if($datalist)
		{
			foreach($datalist as $key => $val)
			{
				$list[]=$val;
			}
		}
		if($list)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_get_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$list;
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		}
		else
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_get_empty');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']="";
			$msg_array['param_keyword']="";
		}
        return response()->json($msg_array);
	}

}
