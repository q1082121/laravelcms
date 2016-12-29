<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :会员中心
*******************************************/
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Model\User;
use App\Http\Model\Userinfo;
use URL;
use Hash;

class UserController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :首页
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('user.user_navigation_center');
		$website['title']=$website['cursitename'];
		//获取用户组数据
		$role_condition['type']=4;
		$rolelist=object_array(DB::table('roles')->where($role_condition)->orderBy('level', 'asc')->get());
		$website['rolelist']=json_encode($rolelist);
		
		return view('user/home')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :用户资料
	*******************************************/
	public function userinfo()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_userinfo');
		$website['title']=$website['cursitename'];
		$area_data_p[]=array('id'=>0,'name'=>trans('admin.option_select_p'),'alias'=>trans('admin.option_select_p'));
		$area_data_c[]=array('id'=>0,'name'=>trans('admin.option_select_c'),'alias'=>trans('admin.option_select_c'));
		$area_data_x[]=array('id'=>0,'name'=>trans('admin.option_select_x'),'alias'=>trans('admin.option_select_x'));
		$website['area_data_p']=json_encode($area_data_p);
		$website['area_data_c']=json_encode($area_data_c);
		$website['area_data_x']=json_encode($area_data_x);

		$website['id']=$this->user['id'];

		return view('user/userinfo/index')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :修改密码
	*******************************************/
	public function edit_pwd()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.define_model_user_editpwd');
		$website['title']=$website['cursitename'];
		$website['id']=$this->user['id'];
		
		return view('user/userinfo/edit_pwd')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :详情接口
	*******************************************/
	public function api_info(Request $request)  
	{

		$condition['user_id']=$request->get('id');
		$info=object_array(DB::table('userinfos')->where($condition)->first());
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
		$condition['user_id']=$request->get('id');

		$params['name']=$request->get('name');
		$params['nick']=$request->get('nick');
		$params['sex']=$request->get('sex');
		$params['birthday']=$request->get('birthday');
		$params['qq']=$request->get('qq');
		$params['area_pid']=$request->get('area_pid');
		$params['area_cid']=$request->get('area_cid');
		$params['area_xid']=$request->get('area_xid');

		//图片上传处理接口
		$attachment='attachment';
		$data_image=$request->get($attachment);
		if($data_image)
		{
			//上传文件归类：获取控制器名称
			$classname=getCurrentControllerName('User');
			$params['attachment']=uploads_action($classname,$data_image,$this->thumb_width,$this->thumb_height,$this->is_thumb,$this->is_watermark,$this->root);
			$params['isattach']=1;
		}

		$info=DB::table('userinfos')->where($condition)->update($params);
		if ($info) 
		{
			action_cache($condition['user_id'],'userinfo','update');

			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_save_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=URL::action('User\UserController@index');
			$msg_array['resource']='';
		} 
		else 
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_save_exit');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
		}
		return response()->json($msg_array);
	}
	/******************************************
	****@AuThor : rubbish.boy@163.com
	****@Title  : 修改密码接口
	****@return : Response
	*******************************************/
	public function api_edit_pwd(Request $request)
	{
		$condition['id']=$request->get('id');
		$user = User::findOrFail($request->get('id'));
		$oldpwd  = $request->get('oldpwd');
		$newpwd  = $request->get('newpwd');
		$surepwd = $request->get('surepwd');
		
		$check=Hash::check($oldpwd, $user->password);
		if($check)
		{
			if($newpwd!=$surepwd)
			{
				$msg_array['status']='0';
				$msg_array['info']=trans('admin.option_editpwd_surefailure');
				$msg_array['is_reload']=0;
				$msg_array['curl']='';
				$msg_array['resource']="";
			}
			else if (strlen($newpwd)<6) 
			{
				$msg_array['status']='0';
				$msg_array['info']=trans('admin.option_editpwd_failurelength');
				$msg_array['is_reload']=0;
				$msg_array['curl']='';
				$msg_array['resource']="";
			}
			else
			{
				$params['password']=Hash::make($newpwd);
				$params['remember_token']="";

				$result=$user->fill($params)->save();
				
				if ($result) 
				{
					$msg_array['status']='1';
					$msg_array['info']=trans('admin.message_edit_success');
					$msg_array['is_reload']=0;
					$msg_array['curl']=URL::action('User\LoginController@logout');
					$msg_array['resource']='';
				} 
				else 
				{
					$msg_array['status']='0';
					$msg_array['info']=trans('admin.message_edit_failure');
					$msg_array['is_reload']=0;
					$msg_array['curl']='';
					$msg_array['resource']="";
				}
			}
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.option_editpwd_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']='';
		}

		return response()->json($msg_array);
	}

}
