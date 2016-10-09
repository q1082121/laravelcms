<?php
/******************************************
****AuThor:rubbish@163.com
****Title :用户
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//使用User模型
use App\Http\Model\User;
use DB;
//使用URL生成地址
use URL;
class UserController extends PublicController
{
	/******************************************
	****AuThor:rubbish@163.com
	****Title :列表
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_five');

		$website['apiurl_list']=URL::action('Admin\UserController@api_list');
		$website['link_edit']='/admin/user/edit/';
		$website['link_set']='/admin/user/set/';
		$website['way']='username';
		$wayoption[]=array('text'=>trans('admin.website_user_item_username'),'value'=>'username');
		$wayoption[]=array('text'=>trans('admin.website_user_item_email'),'value'=>'email');
		$wayoption[]=array('text'=>trans('admin.website_user_item_mobile'),'value'=>'mobile');
		$wayoption[]=array('text'=>trans('admin.website_user_item_nick'),'value'=>'nick');
		$website['wayoption']=json_encode($wayoption);

		return view('admin/user/index')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish@163.com
	****Title :列表接口
	*******************************************/
	public function api_list(Request $request)  
	{
		$search_field=$request->get('way')?$request->get('way'):'title';
		$keyword=$request->get('keyword');
		if($keyword)
		{
			$list=User::join('userinfos', 'userinfos.user_id', '=', 'users.id')->where('users.id', '>', 0)->where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=User::join('userinfos', 'userinfos.user_id', '=', 'users.id')->where('users.id', '>', 0)->paginate($this->pagesize);
			
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
	/******************************************
	****AuThor : rubbish@163.com
	****Title  : 设置
	*******************************************/
	public function set($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_action_set_role');

		$website['apiurl_list']=URL::action('Admin\UserroleController@api_list_related');
		$website['apiurl_get']=URL::action('Admin\UserroleController@api_get_role');
		$website['apiurl_cancel']=URL::action('Admin\UserroleController@api_cancel_role');
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.website_userrole_item_name'),'value'=>'name');
		$wayoption[]=array('text'=>trans('admin.website_userrole_item_display_name'),'value'=>'display_name');
		$wayoption[]=array('text'=>trans('admin.website_userrole_item_description'),'value'=>'description');
		$website['wayoption']=json_encode($wayoption);
		$website['id']=$id;
		$condition['user_id']=$id;
		$info=object_array(DB::table('userinfos')->where($condition)->first());
		$website['info']=$info;
		return view('admin/user/set')->with('website',$website);
	}
}
