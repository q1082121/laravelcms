<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//使用User模型
use App\Http\Model\User;

class UserController extends PublicController
{
	/******************************************
	****AuThor:rubbish@163.com
	****Title :用户列表
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_five');
		return view('admin/user/user')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish@163.com
	****Title :用户列表_数据_api
	*******************************************/
	public function api_user_list(Request $request)  
	{
		$search_field=$request->get('way')?$request->get('way'):'title';
		$keyword=$request->get('keyword');
		if($keyword)
		{
			$list=User::join('userinfos', 'userinfos.user_id', '=', 'users.id')->where('users.id', '>', 0)->where($search_field, 'like', '%'.$keyword.'%')->paginate(1);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=User::join('userinfos', 'userinfos.user_id', '=', 'users.id')->where('users.id', '>', 0)->paginate(1);
			
		}
		

		if($list)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_get_success');
			$msg_array['is_reload']=0;
			$msg_array['resource']=$list;
			$msg_array['param_way']=$search_field;
			$msg_array['param_keyword']=$keyword;
		}
		else
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_get_empty');
			$msg_array['is_reload']=0;
			$msg_array['resource']="";
			$msg_array['param_way']=$search_field;
			$msg_array['param_keyword']=$keyword;
		}
        return response()->json($msg_array);
	}
}
