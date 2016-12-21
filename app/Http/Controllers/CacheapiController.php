<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :获取缓存文件接口 
*******************************************/
namespace App\Http\Controllers;
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
            case 'Home':
                            $cache['navigation']=@$this->cache_navigation;
                            //$cache['class']=@$this->cache_class;
                            //$cache['classlink']=@$this->cache_classlink;
                            //$cache['classproduct']=@$this->cache_classproduct;
                            //$cache['picture']=@$this->cache_picture;
                            //$cache['link']=@$this->cache_link;
                            $info=trans('admin.message_get_success');
            break;
            
        }
		
		$msg_array['status']='1';
		$msg_array['info']=$info;
		$msg_array['is_reload']=0;
		$msg_array['resource']=$cache;

        return response()->json($msg_array);
	}
   
}
