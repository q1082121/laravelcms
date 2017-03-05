<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :用户角色
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//使用Role模型
use App\Http\Model\Role;
//使用User模型
use App\Http\Model\User;
use DB;
//使用内存缓存
use Redis;
use Cache;
//使用URL生成地址
use URL;
class UserroleController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_role');
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_keyval'),'value'=>'name');
		$wayoption[]=array('text'=>trans('admin.fieldname_item_name'),'value'=>'display_name');
		$wayoption[]=array('text'=>trans('admin.fieldname_item_description'),'value'=>'description');
		$website['wayoption']=json_encode($wayoption);

		return view('admin/userrole/index')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加
	*******************************************/
	public function add()
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_role');
		$website['id']=0;
		return view('admin/userrole/add')->with('website',$website);
	}
	/******************************************
	****AuThor : rubbish.boy@163.com
	****Title  : 编辑信息
	*******************************************/
	public function edit($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_role');
		$website['id']=$id;
		return view('admin/userrole/add')->with('website',$website);
	}
	/******************************************
	****AuThor : rubbish.boy@163.com
	****Title  : 设置
	*******************************************/
	public function set($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_action_set_permission');
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_keyval'),'value'=>'name');
		$wayoption[]=array('text'=>trans('admin.fieldname_item_name'),'value'=>'display_name');
		$wayoption[]=array('text'=>trans('admin.fieldname_item_description'),'value'=>'description');
		$website['wayoption']=json_encode($wayoption);
		$website['id']=$id;
		$condition['id']=$id;
		$info=object_array(DB::table('roles')->where($condition)->first());
		$website['info']=$info;
		return view('admin/userrole/set')->with('website',$website);
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
			$list=Role::where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=Role::paginate($this->pagesize);
			
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
		$info_count=Role::where($condition)->count();
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
			$params = new Role;
			$params->name = $request->get('name');
			$params->display_name	= $request->get('display_name');
			$params->description	= $request->get('description');
			$params->type	= 4;
			$params->level	= $request->get('level');
			$params->check_in_score	= $request->get('check_in_score');
			$params->login_get_experience	= $request->get('login_get_experience');
			$params->level_up_experience	= $request->get('level_up_experience');

			if ($params->save()) 
			{
				$msg_array['status']='1';
				$msg_array['info']=trans('admin.message_add_success');
				$msg_array['is_reload']=0;
				$msg_array['curl']=route('get.admin.userrole');
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
		$info=object_array(DB::table('roles')->where($condition)->first());
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

		$params = Role::find($request->get('id'));
		$params->display_name = $request->get('display_name');
		$params->description = $request->get('description');
		$params->level	= $request->get('level');
		$params->check_in_score	= $request->get('check_in_score');
		$params->login_get_experience	= $request->get('login_get_experience');
		$params->level_up_experience	= $request->get('level_up_experience');
		
		if ($params->save()) 
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_save_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=route('get.admin.userrole');
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
	public function api_get_role(Request $request)  
	{
		
		$condition['user_id']=$request->get('id');
		$condition['role_id']=$request->get('role_id');
		$info_count=DB::table('role_user')->where($condition)->count();
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
			switch (1) 
			{
				//扩展接口方法
				case '1':
							$user = User::where('id', '=', $request->get('id'))->first();
							$user->attachRole($request->get('role_id'));

							$msg_array['status']='1';
							$msg_array['info']=trans('admin.message_set_success');
							$msg_array['is_reload']=0;
							$msg_array['curl']='';
							$msg_array['resource']='';
					break;
				//自定义方法	
				case '2':
							$info=DB::table('role_user')->insert($condition);
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
					break;	
				
				default:
					# code...
					break;
			}
			
		}
        return response()->json($msg_array);

	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :取消权限接口
	*******************************************/
	public function api_cancel_role(Request $request)  
	{
		switch (1) 
		{	//扩展接口方法
			case '1':
						$user = User::where('id', '=', $request->get('id'))->first();
						$user->detachRole($request->get('role_id'));

						$msg_array['status']='1';
						$msg_array['info']=trans('admin.message_cancel_success');
						$msg_array['is_reload']=0;
						$msg_array['curl']='';
						$msg_array['resource']='';
				break;
			//自定义方法	
			case '2':
						$condition['role_id']=$request->get('role_id');
						$condition['user_id']=$request->get('id');
						$info=DB::table('role_user')->where($condition)->delete();//返回1;
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
				break;	
			
			default:
				# code...
				break;
		}

        return response()->json($msg_array);

	}
}
