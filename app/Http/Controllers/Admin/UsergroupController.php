<?php
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

class UsergroupController extends PublicController
{
	/******************************************
	****AuThor:rubbish@163.com
	****Title :用户组列表
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_role');
		return view('admin/usergroup/index')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish@163.com
	****Title :用户组添加
	*******************************************/
	public function add()
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_role');
		$website['id']=0;
		return view('admin/usergroup/add')->with('website',$website);
	}
	/******************************************
	****AuThor : rubbish@163.com
	****Title  : 编辑信息
	*******************************************/
	public function edit($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_role');
		$website['id']=$id;
		return view('admin/usergroup/add')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish@163.com
	****Title :用户组列表_数据_api
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
	****Title :用户组_添加数据_api
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
			$role = new Role;
			$role->name = $request->get('name');
			$role->display_name	= $request->get('display_name');
			$role->description	= $request->get('description');

			if ($role->save()) 
			{
				$msg_array['status']='1';
				$msg_array['info']=trans('admin.website_add_success');
				$msg_array['is_reload']=0;
				$msg_array['curl']='/admin/usergroup';
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
}
