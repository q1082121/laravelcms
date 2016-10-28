<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :删除控制器
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
use App\Http\Model\Picture;
use App\Http\Model\Classifylink;
use App\Http\Model\Link;
use App\Http\Model\Log;
use App\Http\Model\Wechat;

class DeleteapiController extends PublicController
{
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :删除接口
	*******************************************/
	public function api_delete(Request $request)  
	{
		$modelname=$request->get('modelname');
		switch($modelname)
		{
			case 'Log':
							$info=$this->delete_action('logs',$request->get('id'));
							if($info)
							{
								$msg_array['status']='1';
								$msg_array['info']=trans('admin.website_del_success');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';
							}
							else
							{
								
								$msg_array['status']='0';
								$msg_array['info']=trans('admin.website_del_failure');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';	
								
							}
			break;
			case 'Navigation':
								$subcondition['topid']=$request->get('id');
								$subinfo=DB::table('navigations')->where($subcondition)->get();
								if($subinfo)
								{
									$msg_array['status']='0';
									$msg_array['info']=trans('admin.navigation_failure_delete');
									$msg_array['is_reload']=0;
									$msg_array['curl']='';
									$msg_array['resource']='';
									$msg_array['param_way']='';
									$msg_array['param_keyword']='';	
								}
								else
								{
									$info=$this->delete_action('navigations',$request->get('id'));
									if($info)
									{
										$msg_array['status']='1';
										$msg_array['info']=trans('admin.website_del_success');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';
									}
									else
									{
										
										$msg_array['status']='0';
										$msg_array['info']=trans('admin.website_del_failure');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';	
										
									}
								}
			break;
			case 'Classify':
								$subcondition['topid']=$request->get('id');
								$subinfo=DB::table('classifies')->where($subcondition)->get();
								if($subinfo)
								{
									$msg_array['status']='0';
									$msg_array['info']=trans('admin.classify_failure_delete');
									$msg_array['is_reload']=0;
									$msg_array['curl']='';
									$msg_array['resource']='';
									$msg_array['param_way']='';
									$msg_array['param_keyword']='';	
								}
								else
								{
									$info=$this->delete_action('classifies',$request->get('id'));
									if($info)
									{
										$msg_array['status']='1';
										$msg_array['info']=trans('admin.website_del_success');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';
									}
									else
									{
										
										$msg_array['status']='0';
										$msg_array['info']=trans('admin.website_del_failure');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';	
										
									}
								}
			break;
			case 'Classifylink':
								$subcondition['topid']=$request->get('id');
								$subinfo=DB::table('classifylinks')->where($subcondition)->get();
								if($subinfo)
								{
									$msg_array['status']='0';
									$msg_array['info']=trans('admin.classifylink_failure_delete');
									$msg_array['is_reload']=0;
									$msg_array['curl']='';
									$msg_array['resource']='';
									$msg_array['param_way']='';
									$msg_array['param_keyword']='';	
								}
								else
								{
									$info=$this->delete_action('classifylinks',$request->get('id'));
									if($info)
									{
										$msg_array['status']='1';
										$msg_array['info']=trans('admin.website_del_success');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';
									}
									else
									{
										
										$msg_array['status']='0';
										$msg_array['info']=trans('admin.website_del_failure');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';	
										
									}
								}
			break;
			case 'Article':
							$info=$this->delete_action('articles',$request->get('id'));
							if($info)
							{
								$msg_array['status']='1';
								$msg_array['info']=trans('admin.website_del_success');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';
							}
							else
							{
								
								$msg_array['status']='0';
								$msg_array['info']=trans('admin.website_del_failure');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';	
								
							}
			break;
			case 'Picture':
							$info=$this->delete_action('pictures',$request->get('id'));
							if($info)
							{
								$msg_array['status']='1';
								$msg_array['info']=trans('admin.website_del_success');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';
							}
							else
							{
								
								$msg_array['status']='0';
								$msg_array['info']=trans('admin.website_del_failure');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';	
								
							}
			break;
			case 'Link':
							$info=$this->delete_action('links',$request->get('id'));
							if($info)
							{
								$msg_array['status']='1';
								$msg_array['info']=trans('admin.website_del_success');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';
							}
							else
							{
								
								$msg_array['status']='0';
								$msg_array['info']=trans('admin.website_del_failure');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';	
								
							}
			break;
			
		}

        return response()->json($msg_array);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :删除操作
	*******************************************/
	public function delete_action($tablename,$id) 
	{
		$condition['id']=$id;
		$info=DB::table($tablename)->where($condition)->delete();//返回1;
		return $info;
	} 
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :清空数据
	*******************************************/
	public function api_clear(Request $request) 
	{
		$modelname=$request->get('modelname');
		switch($modelname)
		{
			case 'Log':
						$info=DB::table('logs')->delete();
			break;
		}
		if($info)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_clear_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$info;
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		}
		else
		{
			
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.website_clear_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$info;
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';	
			
		}

		return response()->json($msg_array);
	}
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
			case 'Navigation':
				$params = Navigation::find($request->get('id'));
				# code...
				break;
			case 'Classify':
				$params = Classify::find($request->get('id'));
				# code...
				break;
			case 'Classifylink':
				$params = Classifylink::find($request->get('id'));
				# code...
				break;	
			case 'Article':
				$params = Article::find($request->get('id'));
				# code...
				break;
			case 'Picture':
				$params = Picture::find($request->get('id'));
				# code...
				break;	
			case 'Wechat':
				$params = Wechat::find($request->get('id'));
				# code...
				break;		
			case 'Link':
				$params = Picture::find($request->get('id'));
				# code...
				break;		
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
			$result=$this->del_image_action($classname,$params['attachment']);
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
							$msg_array['info']=trans('admin.website_del_success');
							$msg_array['is_reload']=1;
							$msg_array['curl']='';
							$msg_array['resource']='';
							$msg_array['param_way']='';
							$msg_array['param_keyword']='';
						} 
						else 
						{
							$msg_array['status']='0';
							$msg_array['info']=trans('admin.website_del_failure');
							$msg_array['is_reload']=0;
							$msg_array['curl']='';
							$msg_array['resource']="";
							$msg_array['param_way']='';
							$msg_array['param_keyword']='';	
						}
				break;
				case 2:
						$params2['attachment']="";
						$params2['isattach']=0;
						$info=DB::table($tablename)->where($condition)->update($params2);
						if ($info) 
						{
							$msg_array['status']='1';
							$msg_array['info']=trans('admin.website_del_success');
							$msg_array['is_reload']=1;
							$msg_array['curl']='';
							$msg_array['resource']='';
							$msg_array['param_way']='';
							$msg_array['param_keyword']='';
						} 
						else 
						{
							$msg_array['status']='0';
							$msg_array['info']=trans('admin.website_del_failure');
							$msg_array['is_reload']=0;
							$msg_array['curl']='';
							$msg_array['resource']="";
							$msg_array['param_way']='';
							$msg_array['param_keyword']='';	
						}
				break;
			}
			
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.website_del_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		}
		
		return response()->json($msg_array);
	}

}
