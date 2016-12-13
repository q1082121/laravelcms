<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :一键操作
*******************************************/
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use URL;
use App\Http\Model\Letter;

class OneactionapiController extends PublicController
{
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :获取一键操作接口
	*******************************************/
	public function api_one_action(Request $request)  
	{
		$modelname=$request->get('modelname');
		$fields=$request->get('fields')?$request->get('fields'):'status';
		switch($modelname)
		{				
			case 'Letter':
							switch ($fields) 
							{
								//收件箱星标记
								case 'isstar_to':
											$params = Letter::find($request->get('id'));
											$params->isstar_to=($params->isstar_to==1?0:1);
											if ($params->save()) 
											{
												$msg_array['status']='1';
												$msg_array['info']=$params->isstar_to==1?trans('admin.message_star_success'):trans('admin.message_star_success2');
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
								//发送箱星标记	
								case 'isstar_from':
											$params = Letter::find($request->get('id'));
											$params->isstar_from=($params->isstar_from==1?0:1);
											if ($params->save()) 
											{
												$msg_array['status']='1';
												$msg_array['info']=$params->isstar_from==1?trans('admin.message_star_success'):trans('admin.message_star_success2');
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
								//收件箱仍垃圾箱	
								case 'istrash_to':
											$params = Letter::find($request->get('id'));
											$params->istrash_to=($params->istrash_to==1?0:1);
											if ($params->save()) 
											{
												$msg_array['status']='1';
												$msg_array['info']=$params->istrash_to==1?trans('admin.message_trash_success'):trans('admin.message_trash_success2');
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
								//发件箱仍垃圾箱	
								case 'istrash_from':
											$params = Letter::find($request->get('id'));
											$params->istrash_from=($params->istrash_from==1?0:1);
											if ($params->save()) 
											{
												$msg_array['status']='1';
												$msg_array['info']=$params->istrash_from==1?trans('admin.message_trash_success'):trans('admin.message_trash_success2');
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
								//收件箱垃圾箱删除	
								case 'isdel_to':
											$params = Letter::find($request->get('id'));
											$params->isdel_to=($params->isdel_to==1?0:1);
											if ($params->save()) 
											{
												$msg_array['status']='1';
												$msg_array['info']=trans('admin.message_del_trash_success');
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
								//发件箱垃圾箱删除	
								case 'isdel_from':
											$params = Letter::find($request->get('id'));
											$params->isdel_from=($params->isdel_from==1?0:1);
											if ($params->save()) 
											{
												$msg_array['status']='1';
												$msg_array['info']=trans('admin.message_del_trash_success');
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
							}				
			break;
		}

        return response()->json($msg_array);

	}

}
