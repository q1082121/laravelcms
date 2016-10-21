<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :一键操作
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
//使用URL生成地址
use URL;

use App\Http\Model\Article;
use App\Http\Model\Classify;
use App\Http\Model\User;
use App\Http\Model\Picture;
use App\Http\Model\Link;
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
			case 'User':
							switch ($fields) 
							{
								//扩展接口方法
								case 'is_lock':
												$params = User::find($request->get('id'));
												$params->is_lock=($params->is_lock==1?0:1);
												if ($params->save()) 
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
								break;
							}
			break;
			case 'Classify':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Classify::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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

									break;
							}
			break;
			case 'Article':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Article::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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

									break;
							}
			break;
			case 'Picture':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Picture::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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

									break;
							}
			break;
			case 'Link':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Link::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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

									break;
							}
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
												$msg_array['info']=$params->isstar_to==1?trans('admin.website_letter_action_star_success'):trans('admin.website_letter_action_star_success2');
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

									break;
								//发送箱星标记	
								case 'isstar_from':
											$params = Letter::find($request->get('id'));
											$params->isstar_from=($params->isstar_from==1?0:1);
											if ($params->save()) 
											{
												$msg_array['status']='1';
												$msg_array['info']=$params->isstar_from==1?trans('admin.website_letter_action_star_success'):trans('admin.website_letter_action_star_success2');
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

									break;
								//收件箱仍垃圾箱	
								case 'istrash_to':
											$params = Letter::find($request->get('id'));
											$params->istrash_to=($params->istrash_to==1?0:1);
											if ($params->save()) 
											{
												$msg_array['status']='1';
												$msg_array['info']=$params->istrash_to==1?trans('admin.website_letter_action_trash_success'):trans('admin.website_letter_action_trash_success2');
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

									break;	
								//发件箱仍垃圾箱	
								case 'istrash_from':
											$params = Letter::find($request->get('id'));
											$params->istrash_from=($params->istrash_from==1?0:1);
											if ($params->save()) 
											{
												$msg_array['status']='1';
												$msg_array['info']=$params->istrash_from==1?trans('admin.website_letter_action_trash_success'):trans('admin.website_letter_action_trash_success2');
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

									break;
								//收件箱垃圾箱删除	
								case 'isdel_to':
											$params = Letter::find($request->get('id'));
											$params->isdel_to=($params->isdel_to==1?0:1);
											if ($params->save()) 
											{
												$msg_array['status']='1';
												$msg_array['info']=trans('admin.website_letter_action_del_trash_success');
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

									break;
								//发件箱垃圾箱删除	
								case 'isdel_from':
											$params = Letter::find($request->get('id'));
											$params->isdel_from=($params->isdel_from==1?0:1);
											if ($params->save()) 
											{
												$msg_array['status']='1';
												$msg_array['info']=trans('admin.website_letter_action_del_trash_success');
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

									break;					
							}				
			break;
		}

        return response()->json($msg_array);

	}

}
