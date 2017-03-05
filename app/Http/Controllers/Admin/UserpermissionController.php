<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :角色权限
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//使用Permission模型
use App\Http\Model\Permission;
use DB;
//使用内存缓存
use Redis;
use Cache;
//使用URL生成地址
use URL;
class UserpermissionController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_permission');
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_keyval'),'value'=>'name');
		$wayoption[]=array('text'=>trans('admin.fieldname_item_name'),'value'=>'display_name');
		$wayoption[]=array('text'=>trans('admin.fieldname_item_description'),'value'=>'description');
		$website['wayoption']=json_encode($wayoption);

		return view('admin/userpermission/index')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加
	*******************************************/
	public function add()
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_permission');
		$website['id']=0;
		return view('admin/userpermission/add')->with('website',$website);
	}
	/******************************************
	****AuThor : rubbish.boy@163.com
	****Title  : 编辑信息
	*******************************************/
	public function edit($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_permission');
		$website['id']=$id;
		return view('admin/userpermission/add')->with('website',$website);
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
			$list=Permission::where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=Permission::paginate($this->pagesize);
			
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
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加接口
	*******************************************/
	public function api_add(Request $request)  
	{
		$condition['name']=$request->get('name');
		$info_count=Permission::where($condition)->count();
		if($info_count)
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_add_exit');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
		}
		else
		{
			$params = new Permission;
			$params->name = $request->get('name');
			$params->display_name	= $request->get('display_name');
			$params->description	= $request->get('description');

			if ($params->save()) 
			{
				$msg_array['status']='1';
				$msg_array['info']=trans('admin.message_add_success');
				$msg_array['is_reload']=0;
				$msg_array['curl']=route('get.admin.userpermission');
				$msg_array['resource']='';
			} 
			else 
			{
				$msg_array['status']='0';
				$msg_array['info']=trans('admin.message_add_failure');
				$msg_array['is_reload']=0;
				$msg_array['curl']='';
				$msg_array['resource']="";
			}	
		}
        return response()->json($msg_array);

	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :详情接口
	*******************************************/
	public function api_info(Request $request)  
	{

		$condition['id']=$request->get('id');
		$info=object_array(DB::table('permissions')->where($condition)->first());
		if($info)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_get_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$info;
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_get_empty');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
		}
        return response()->json($msg_array);
	}
	/******************************************
	****@AuThor : rubbish.boy@163.com
	****@Title  : 更新数据接口
	****@return : Response
	*******************************************/
	public function api_edit(Request $request)
	{

		$params = Permission::find($request->get('id'));
		$params->display_name = $request->get('display_name');
		$params->description = $request->get('description');
		
		if ($params->save()) 
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_save_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=route('get.admin.userpermission');
			$msg_array['resource']='';
		} 
		else 
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_save_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";	
		}
		return response()->json($msg_array);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :关联列表接口
	*******************************************/
	public function api_list_related(Request $request)  
	{
		$search_field=$request->get('way')?$request->get('way'):'title';
		$role_id=$request->get('role_id');
		$keyword=$request->get('keyword');
		if($keyword)
		{
			$list=Permission::leftJoin('permission_role as b', function($join)use($role_id)
			{$join->on('permissions.id', '=', 'b.permission_id')->where('b.role_id','=',$role_id);}
			)->where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field,'role_id'=>$role_id])->links();
		}
		else
		{
			$list=Permission::leftJoin('permission_role as b',  function($join)use($role_id)
			{$join->on('permissions.id', '=', 'b.permission_id')->where('b.role_id','=',$role_id);}
			)->paginate($this->pagesize);
			$list->appends(['role_id' => $role_id])->links();
			
		}
		if($list)
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
			$msg_array['resource']="";
			$msg_array['way']=$search_field;
			$msg_array['keyword']=$keyword;
		}
        return response()->json($msg_array);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :获取权限接口
	*******************************************/
	public function api_get_permission(Request $request)  
	{
		$condition['permission_id']=$request->get('permission_id');
		$condition['role_id']=$request->get('id');
		$info_count=DB::table('permission_role')->where($condition)->count();
		if($info_count)
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_add_exit');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
		}
		else
		{
			$info=DB::table('permission_role')->insert($condition);
			if($info)//true
			{
				$msg_array['status']='1';
				$msg_array['info']=trans('admin.message_set_success');
				$msg_array['is_reload']=0;
				$msg_array['curl']='';
				$msg_array['resource']='';
			}
			else
			{
				$msg_array['status']='0';
				$msg_array['info']=trans('admin.message_set_failure');
				$msg_array['is_reload']=0;
				$msg_array['curl']='';
				$msg_array['resource']="";	
			}
			
		}
        return response()->json($msg_array);

	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :取消权限接口
	*******************************************/
	public function api_cancel_permission(Request $request)  
	{
		$condition['permission_id']=$request->get('permission_id');
		$condition['role_id']=$request->get('id');
		$info=DB::table('permission_role')->where($condition)->delete();//返回1;
		if($info)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_cancel_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']='';
		}
		else
		{
			
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_cancel_error');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']='';
		}
        return response()->json($msg_array);

	}
}
