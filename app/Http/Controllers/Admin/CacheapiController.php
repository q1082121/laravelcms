<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :生成缓存文件接口 
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
//使用URL生成地址
use URL;
use Cache;
//使用内存缓存
use Redis;

class CacheapiController extends PublicController
{
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :处理系统缓存
	*******************************************/
	public function api_cache(Request $request)
	{
        $modelname=$request->get('modelname');
        switch($modelname)
        {
            case 'Setting':
                            $getdata=$request->all();
		                    Cache::store('file')->forever('root', $getdata);
                            $info=trans('admin.website_save_success');
            break;
            case 'Classify':
                            $getdata="";
                            $list=object_array(DB::table('classifies')->orderBy('id', 'asc')->get());
                            if(is_array($list))
                            {
                                foreach($list as $key=>$val)
                                {
                                    $getdata[$val['id']]=$val;
                                }
                            }
		                    Cache::store('file')->forever('class', $getdata);
                            $info=trans('admin.website_create_success');
            break;
            case 'Picture':
                            $getdata="";
                            $list=object_array(DB::table('pictures')->orderBy('id', 'asc')->get());
                            if(is_array($list))
                            {
                                foreach($list as $key=>$val)
                                {
                                    $getdata[$val['id']]=$val;
                                }
                            }
		                    Cache::store('file')->forever('picture', $getdata);
                            $info=trans('admin.website_create_success');
            break;
        }
		
		$msg_array['status']='1';
		$msg_array['info']=$info;
		$msg_array['is_reload']=0;
		$msg_array['resource']=$getdata;

        return response()->json($msg_array);
	}
   
}
