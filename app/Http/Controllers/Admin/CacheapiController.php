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
use URL;
use Cache;
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
                            $info=trans('admin.message_save_success');
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
                            $info=trans('admin.message_create_success');
            break;                
            case 'Navigation':
                            $getdata="";
                            $list=object_array(DB::table('navigations')->orderBy('id', 'asc')->get());
                            if(is_array($list))
                            {
                                foreach($list as $key=>$val)
                                {
                                    $getdata[$val['id']]=$val;
                                }
                            }
		                    Cache::store('file')->forever('navigation', $getdata);
                            $info=trans('admin.message_create_success'); 
            break;                               
            case 'Classifylink':
                            $getdata="";
                            $list=object_array(DB::table('classifylinks')->orderBy('id', 'asc')->get());
                            if(is_array($list))
                            {
                                foreach($list as $key=>$val)
                                {
                                    $getdata[$val['id']]=$val;
                                }
                            }
		                    Cache::store('file')->forever('classlink', $getdata);
                            $info=trans('admin.message_create_success');                
            break;
            case 'Classifyproduct':
                            $getdata="";
                            $list=object_array(DB::table('classifyproducts')->orderBy('id', 'asc')->get());
                            if(is_array($list))
                            {
                                foreach($list as $key=>$val)
                                {
                                    $getdata[$val['id']]=$val;
                                }
                            }
		                    Cache::store('file')->forever('classproduct', $getdata);
                            $info=trans('admin.message_create_success');                
            break;
            case 'Classifyquestion':
                            $getdata="";
                            $list=object_array(DB::table('classifyquestions')->orderBy('id', 'asc')->get());
                            if(is_array($list))
                            {
                                foreach($list as $key=>$val)
                                {
                                    $getdata[$val['id']]=$val;
                                }
                            }
		                    Cache::store('file')->forever('classquestion', $getdata);
                            $info=trans('admin.message_create_success');                
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
                            $info=trans('admin.message_create_success');
            break;
            case 'Link':
                            $getdata="";
                            $list=object_array(DB::table('links')->orderBy('id', 'asc')->get());
                            if(is_array($list))
                            {
                                foreach($list as $key=>$val)
                                {
                                    $getdata[$val['id']]=$val;
                                }
                            }
		                    Cache::store('file')->forever('link', $getdata);
                            $info=trans('admin.message_create_success');
            break;
            case 'Attributegroup':
                            $getdata="";
                            $list=object_array(DB::table('attributegroups')->orderBy('id', 'asc')->get());
                            if(is_array($list))
                            {
                                foreach($list as $key=>$val)
                                {
                                    $getdata[$val['id']]=$val;
                                }
                            }
		                    Cache::store('file')->forever('attributegroup', $getdata);
                            $info=trans('admin.message_create_success');
            break;
            case 'Attributevalue':
                            $getdata="";
                            $list=object_array(DB::table('attributevalues')->orderBy('id', 'asc')->get());
                            if(is_array($list))
                            {
                                foreach($list as $key=>$val)
                                {
                                    $getdata[$val['id']]=$val;
                                }
                            }
		                    Cache::store('file')->forever('attributevalue', $getdata);
                            $info=trans('admin.message_create_success');
            break;
        }
		
		$msg_array['status']='1';
		$msg_array['info']=$info;
		$msg_array['is_reload']=0;
		$msg_array['resource']=$getdata;

        return response()->json($msg_array);
	}
   
}
