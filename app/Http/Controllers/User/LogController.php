<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :日志管理
*******************************************/
namespace App\Http\Controllers\User;

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
		$website['cursitename']=trans('user.user_navigation_log');
		$website['title']=$website['cursitename'];
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_name'),'value'=>'name');
		$wayoption[]=array('text'=>trans('admin.fieldname_item_info'),'value'=>'info');
		$website['wayoption']=json_encode($wayoption);
        

		return view('user/log/index')->with('website',$website);
	}

    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表接口
	*******************************************/
	public function api_list(Request $request)  
	{
		$search_field=$request->get('way')?$request->get('way'):'title';
		$condition['user_id']=$this->user['id'];
		$keyword=$request->get('keyword');
		if($keyword)
		{
			$list=Log::where($condition)->where($search_field, 'like', '%'.$keyword.'%')->orderBy('updated_at','desc')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=Log::where($condition)->orderBy('updated_at','desc')->paginate($this->pagesize);
		}
		if($list && $list->total()>0)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_get_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$list;
			$msg_array['way']=$search_field;
			$msg_array['keyword']=$keyword;
		}
		else
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_get_empty');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$list;
			$msg_array['way']=$search_field;
			$msg_array['keyword']=$keyword;
		}
        return response()->json($msg_array);
	}

}
