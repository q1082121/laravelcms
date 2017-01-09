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
use App\Http\Model\Navigation;
use App\Http\Model\Classify;
use App\Http\Model\User;
use App\Http\Model\Classifyproduct;
use App\Http\Model\Product;
use App\Http\Model\Productattribute;
use App\Http\Model\Picture;
use App\Http\Model\Classifylink;
use App\Http\Model\Link;
use App\Http\Model\Classifyquestion;
use App\Http\Model\Question;
use App\Http\Model\Questionoption;
use App\Http\Model\Letter;
use App\Http\Model\Wechat;
use App\Http\Model\Wechatreplytext;
use App\Http\Model\Wechatreplyimagetext;
use App\Http\Model\Classifywechat;
use App\Http\Model\Wechatuser;
use App\Http\Model\Xcxmp;
use App\Http\Model\Attributegroup;
use App\Http\Model\Attributevalue;
use App\Http\Model\Expresstemplate;
use App\Http\Model\Expressvalue;

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
							}
			break;
			case 'Navigation':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Navigation::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Classifylink':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Classifylink::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Classifyproduct':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Classifyproduct::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Classifyquestion':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Classifyquestion::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Classifywechat':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Classifywechat::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Product':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Product::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Question':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Question::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Questionoption':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Questionoption::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
								case 'is_answer':
											$params = Questionoption::find($request->get('id'));
											$params->is_answer=($params->is_answer==1?0:1);
											if ($params->save()) 
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
							}
			break;								
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
			case 'Wechat':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Wechat::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Wechatreplytext':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Wechatreplytext::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Wechatreplyimagetext':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Wechatreplyimagetext::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Wechatuser':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Wechatuser::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Xcxmp':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Xcxmp::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Attributegroup':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Attributegroup::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Attributevalue':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Attributevalue::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Productattribute':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Productattribute::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			case 'Expresstemplate':
							switch ($fields) 
							{
								//扩展接口方法
								case 'isdefault':
											$params = Expresstemplate::find($request->get('id'));
											if($params->isdefault==1)
											{
												$params->isdefault=0;
												if ($params->save()) 
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
											else
											{
												$allparams['isdefault']=0;
												DB::table('expresstemplates')->update($allparams);
												$params->isdefault=1;
												if ($params->save()) 
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
									break;
							}
			break;
			case 'Expressvalue':
							switch ($fields) 
							{
								//扩展接口方法
								case 'status':
											$params = Expressvalue::find($request->get('id'));
											$params->status=($params->status==1?0:1);
											if ($params->save()) 
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
							}
			break;
			
			
		}

        return response()->json($msg_array);

	}

}
