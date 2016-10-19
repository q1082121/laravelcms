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
use App\Http\Model\Classify;
use App\Http\Model\Picture;
use App\Http\Model\Link;
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
	****@AuThor : rubbish.boy@163.com
	****@Title  : 删除图片
	****@return : Response
	*******************************************/
	public function api_del_image(Request $request)
	{
		$classname=$request->get('modelname');
		switch ($classname) 
		{
			case 'Classify':
				$params = Classify::find($request->get('id'));
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
			case 'Link':
				$params = Picture::find($request->get('id'));
				# code...
				break;				
		}
		
		if($params['isattach']==1)
		{
			$result=$this->del_image_action($classname,$params['attachment']);
		}
		if($result)
		{
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
