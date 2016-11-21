<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :成才经验
*******************************************/
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Experience;
use DB;
use URL;

class ExperienceController extends PublicController
{
    //
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['modelname']=getCurrentControllerName('User');
		$website['cursitename']=trans('user.user_navigation_experience');
		$website['title']=$website['cursitename'];
		$website['apiurl_list']=route('post.user.experience.api_list');
		$website['way']='info';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_info'),'value'=>'info');
		$website['wayoption']=json_encode($wayoption);

		return view('user/experience/index')->with('website',$website);
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
			$list=Experience::where($condition)->where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=Experience::where($condition)->paginate($this->pagesize);
		}
		if($list)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_get_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$list;
			$msg_array['param_way']=$search_field;
			$msg_array['param_keyword']=$keyword;
		}
		else
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_get_empty');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']=$search_field;
			$msg_array['param_keyword']=$keyword;
		}
        return response()->json($msg_array);
	}

}
