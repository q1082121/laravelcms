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
													$msg_array['curl']=URL::action('Admin\UserController@index');
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
												$msg_array['curl']=URL::action('Admin\ClassifyController@index');
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
												$msg_array['curl']=URL::action('Admin\ArticleController@index');
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
												$msg_array['curl']=URL::action('Admin\PictureController@index');
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
												$msg_array['curl']=URL::action('Admin\LinkController@index');
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
