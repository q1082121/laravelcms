<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :删除控制器
*******************************************/
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use URL;

class DeleteapiController extends PublicController
{
	/******************************************
	****@AuThor : rubbish.boy@163.com
	****@Title  : 删除图片
	****@return : Response
	*******************************************/
	public function api_del_image(Request $request)
	{
		$classname=$request->get('modelname');
		$type=1;
		switch ($classname) 
		{
			case 'User':
				$condition['id']=$request->get('id');
				$tablename="userinfos";
				$params = object_array(DB::table($tablename)->where($condition)->first());
				$type=2;
				# code...
				break;							
		}
		
		if($params['isattach']==1)
		{
			$result=del_image_action($classname,$params['attachment']);
		}
		else
		{
			$result=0;
		}
		if($result)
		{
			switch($type)
			{
				case 1:
						$params->attachment='';
						$params->isattach=0;

						if ($params->save()) 
						{
							$msg_array['status']='1';
							$msg_array['info']=trans('admin.message_del_success');
							$msg_array['is_reload']=1;
							$msg_array['curl']='';
							$msg_array['resource']='';
						} 
						else 
						{
							$msg_array['status']='0';
							$msg_array['info']=trans('admin.message_del_failure');
							$msg_array['is_reload']=0;
							$msg_array['curl']='';
							$msg_array['resource']="";
						}
				break;
				case 2:
						$params2['attachment']="";
						$params2['isattach']=0;
						$info=DB::table($tablename)->where($condition)->update($params2);
						if ($info) 
						{
							$msg_array['status']='1';
							$msg_array['info']=trans('admin.message_del_success');
							$msg_array['is_reload']=1;
							$msg_array['curl']='';
							$msg_array['resource']='';
						} 
						else 
						{
							$msg_array['status']='0';
							$msg_array['info']=trans('admin.message_del_failure');
							$msg_array['is_reload']=0;
							$msg_array['curl']='';
							$msg_array['resource']="";
						}
				break;
			}
			
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_del_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
		}
		
		return response()->json($msg_array);
	}

}
