<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :日志管理
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\Log;
use DB;
use URL;
class LogController extends PublicController
{
    //
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['modelname']=getCurrentControllerName();
		$website['cursitename']=trans('admin.website_navigation_three');
		$website['apiurl_list']=URL::action('Admin\LogController@api_list');
		$website['apiurl_delete']=URL::action('Admin\DeleteapiController@api_delete');
		$website['apiurl_clear']=URL::action('Admin\DeleteapiController@api_clear');
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.website_log_item_name'),'value'=>'name');
		$website['wayoption']=json_encode($wayoption);
        $website['modellist']=$this->link_modellist;
        

		return view('admin/log/index')->with('website',$website);
	}

    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表接口
	*******************************************/
	public function api_list(Request $request)  
	{
		$search_field=$request->get('way')?$request->get('way'):'title';
		$keyword=$request->get('keyword');
		if($keyword)
		{
			$list=Log::where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=Log::paginate($this->pagesize);
		}
		if($list)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_get_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$list;
			$msg_array['param_way']=$search_field;
			$msg_array['param_keyword']=$keyword;
		}
		else
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_get_empty');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']=$search_field;
			$msg_array['param_keyword']=$keyword;
		}
        return response()->json($msg_array);
	}

}
