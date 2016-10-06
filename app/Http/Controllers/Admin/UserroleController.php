<?php
/******************************************
****AuThor:rubbish@163.com
****Title :用户角色
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//使用Role模型
use App\Http\Model\Role;
use DB;
//使用内存缓存
use Redis;
use Cache;
//使用URL生成地址
use URL;
class UserroleController extends PublicController
{
	/******************************************
	****AuThor:rubbish@163.com
	****Title :列表
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_role');

		$website['apiurl_list']=URL::action('Admin\UserroleController@api_list');
		$website['link_add']=URL::action('Admin\UserroleController@add');
		$website['link_edit']='/admin/userrole/edit/';
		$website['link_set']='/admin/userrole/set/';
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.website_userrole_item_name'),'value'=>'name');
		$wayoption[]=array('text'=>trans('admin.website_userrole_item_display_name'),'value'=>'display_name');
		$wayoption[]=array('text'=>trans('admin.website_userrole_item_description'),'value'=>'description');
		$website['wayoption']=json_encode($wayoption);

		return view('admin/userrole/index')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish@163.com
	****Title :添加
	*******************************************/
	public function add()
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_role');
		$website['apiurl_add']=URL::action('Admin\UserroleController@api_add');
		$website['apiurl_info']=URL::action('Admin\UserroleController@api_info');
		$website['apiurl_edit']=URL::action('Admin\UserroleController@api_edit');
		$website['id']=0;
		return view('admin/userrole/add')->with('website',$website);
	}
	/******************************************
	****AuThor : rubbish@163.com
	****Title  : 编辑信息
	*******************************************/
	public function edit($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_role');
		$website['apiurl_add']=URL::action('Admin\UserroleController@api_add');
		$website['apiurl_info']=URL::action('Admin\UserroleController@api_info');
		$website['apiurl_edit']=URL::action('Admin\UserroleController@api_edit');
		$website['id']=$id;
		return view('admin/userrole/add')->with('website',$website);
	}
	/******************************************
	****AuThor : rubbish@163.com
	****Title  : 设置
	*******************************************/
	public function set($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_action_set_permission');

		$website['apiurl_list']=URL::action('Admin\UserpermissionController@api_list_related');
		$website['apiurl_get']=URL::action('Admin\UserpermissionController@api_get_permission');
		$website['apiurl_cancel']=URL::action('Admin\UserpermissionController@api_cancel_permission');
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.website_userpermission_item_name'),'value'=>'name');
		$wayoption[]=array('text'=>trans('admin.website_userpermission_item_display_name'),'value'=>'display_name');
		$wayoption[]=array('text'=>trans('admin.website_userpermission_item_description'),'value'=>'description');
		$website['wayoption']=json_encode($wayoption);
		$website['id']=$id;
		$condition['id']=$id;
		$info=object_array(DB::table('roles')->where($condition)->first());
		$website['info']=$info;
		return view('admin/userrole/set')->with('website',$website);
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
			$list=Role::where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=Role::paginate($this->pagesize);
			
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
	****AuThor:rubbish@163.com
	****Title :添加接口
	*******************************************/
	public function api_add(Request $request)  
	{
		$condition['name']=$request->get('name');
		$info_count=Role::where($condition)->count();
		if($info_count)
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.website_add_exit');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';	
		}
		else
		{
			$params = new Role;
			$params->name = $request->get('name');
			$params->display_name	= $request->get('display_name');
			$params->description	= $request->get('description');

			if ($params->save()) 
			{
				$msg_array['status']='1';
				$msg_array['info']=trans('admin.website_add_success');
				$msg_array['is_reload']=0;
				$msg_array['curl']=URL::action('Admin\UserroleController@index');
				$msg_array['resource']='';
				$msg_array['param_way']='';
				$msg_array['param_keyword']='';
			} 
			else 
			{
				$msg_array['status']='0';
				$msg_array['info']=trans('admin.website_add_failure');
				$msg_array['is_reload']=0;
				$msg_array['curl']='';
				$msg_array['resource']="";
				$msg_array['param_way']='';
				$msg_array['param_keyword']='';	

			}	
		}
        return response()->json($msg_array);

	}
	/******************************************
	****AuThor:rubbish@163.com
	****Title :详情接口
	*******************************************/
	public function api_info(Request $request)  
	{

		$condition['id']=$request->get('id');
		$info=DB::table('roles')->where($condition)->first();
		if($info)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_get_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$info;
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.website_get_empty');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		}
        return response()->json($msg_array);
	}
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 更新数据接口
	****@return : Response
	*******************************************/
	public function api_edit(Request $request)
	{

		$params = Role::find($request->get('id'));
		$params->display_name = $request->get('display_name');
		$params->description = $request->get('description');
		
		if ($params->save()) 
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_save_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=URL::action('Admin\UserroleController@index');
			$msg_array['resource']='';
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		} 
		else 
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.website_save_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';	
		}
		return response()->json($msg_array);
	}
	/******************************************
	****AuThor:rubbish@163.com
	****Title :关联列表接口
	*******************************************/
	public function api_list_related(Request $request)  
	{
		$search_field=$request->get('way')?$request->get('way'):'title';
		$user_id=$request->get('user_id');
		$keyword=$request->get('keyword');
		if($keyword)
		{
			$list=Role::leftJoin('role_user as b', function($join)use($role_id)
			{$join->on('roles.id', '=', 'b.role_id')->where('b.user_id','=',$user_id);}
			)->where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field,'user_id'=>$user_id])->links();
		}
		else
		{
			$list=Role::leftJoin('role_user as b',  function($join)use($user_id)
			{$join->on('roles.id', '=', 'b.role_id')->where('b.user_id','=',$user_id);}
			)->paginate($this->pagesize);
			$list->appends(['user_id' => $user_id])->links();
			
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
	****AuThor:rubbish@163.com
	****Title :获取权限接口
	*******************************************/
	public function api_get_role(Request $request)  
	{
		$condition['role_id']=$request->get('role_id');
		$condition['user_id']=$request->get('id');
		$info_count=DB::table('role_user')->where($condition)->count();
		if($info_count)
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.website_add_exit');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';	
		}
		else
		{
			$info=DB::table('role_user')->insert($condition);
			if($info)//true
			{
				$msg_array['status']='1';
				$msg_array['info']=trans('admin.website_action_set_success');
				$msg_array['is_reload']=0;
				$msg_array['curl']='';
				$msg_array['resource']='';
				$msg_array['param_way']='';
				$msg_array['param_keyword']='';
			}
			else
			{
				$msg_array['status']='0';
				$msg_array['info']=trans('admin.website_action_set_failure');
				$msg_array['is_reload']=0;
				$msg_array['curl']='';
				$msg_array['resource']="";
				$msg_array['param_way']='';
				$msg_array['param_keyword']='';	
			}
			
		}
        return response()->json($msg_array);

	}
	/******************************************
	****AuThor:rubbish@163.com
	****Title :取消权限接口
	*******************************************/
	public function api_cancel_role(Request $request)  
	{
		$condition['role_id']=$request->get('role_id');
		$condition['user_id']=$request->get('id');
		$info=DB::table('role_user')->where($condition)->delete();//返回1;
		if($info)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_cancel_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']='';
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		}
		else
		{
			
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.website_cancel_error');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']='';
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';	
			
		}
        return response()->json($msg_array);

	}
}
