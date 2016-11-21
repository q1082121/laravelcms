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
use URL;
use App\Http\Model\Article;
use App\Http\Model\Navigation;
use App\Http\Model\Classify;
use App\Http\Model\Classifyproduct;
use App\Http\Model\Product;
use App\Http\Model\Picture;
use App\Http\Model\Classifylink;
use App\Http\Model\Link;
use App\Http\Model\Classifyquestion;
use App\Http\Model\Question;
use App\Http\Model\Questionoption;
use App\Http\Model\Log;
use App\Http\Model\Wechat;
use App\Http\Model\Wechatreplytext;
use App\Http\Model\Wechatreplyimagetext;

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
								$msg_array['info']=trans('admin.message_del_success');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';
							}
							else
							{
								
								$msg_array['status']='0';
								$msg_array['info']=trans('admin.message_del_failure');
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
									$msg_array['info']=trans('admin.message_failure_delete_sub');
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
										$msg_array['info']=trans('admin.message_del_success');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';
									}
									else
									{
										
										$msg_array['status']='0';
										$msg_array['info']=trans('admin.message_del_failure');
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
									$msg_array['info']=trans('admin.message_failure_delete_sub');
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
										$msg_array['info']=trans('admin.message_del_success');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';
									}
									else
									{
										
										$msg_array['status']='0';
										$msg_array['info']=trans('admin.message_del_failure');
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
									$msg_array['info']=trans('admin.message_failure_delete_sub');
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
										$msg_array['info']=trans('admin.message_del_success');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';
									}
									else
									{
										
										$msg_array['status']='0';
										$msg_array['info']=trans('admin.message_del_failure');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';	
										
									}
								}
			break;
			case 'Classifyproduct':
								$subcondition['topid']=$request->get('id');
								$subinfo=DB::table('classifyproducts')->where($subcondition)->get();
								if($subinfo)
								{
									$msg_array['status']='0';
									$msg_array['info']=trans('admin.message_failure_delete_sub');
									$msg_array['is_reload']=0;
									$msg_array['curl']='';
									$msg_array['resource']='';
									$msg_array['param_way']='';
									$msg_array['param_keyword']='';	
								}
								else
								{
									$info=$this->delete_action('classifyproducts',$request->get('id'));
									if($info)
									{
										$msg_array['status']='1';
										$msg_array['info']=trans('admin.message_del_success');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';
									}
									else
									{
										
										$msg_array['status']='0';
										$msg_array['info']=trans('admin.message_del_failure');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';	
										
									}
								}
			break;
			case 'Classifyquestion':
								$subcondition['topid']=$request->get('id');
								$subinfo=DB::table('classifyquestions')->where($subcondition)->get();
								if($subinfo)
								{
									$msg_array['status']='0';
									$msg_array['info']=trans('admin.message_failure_delete_sub');
									$msg_array['is_reload']=0;
									$msg_array['curl']='';
									$msg_array['resource']='';
									$msg_array['param_way']='';
									$msg_array['param_keyword']='';	
								}
								else
								{
									$info=$this->delete_action('classifyquestions',$request->get('id'));
									if($info)
									{
										$msg_array['status']='1';
										$msg_array['info']=trans('admin.message_del_success');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';
									}
									else
									{
										
										$msg_array['status']='0';
										$msg_array['info']=trans('admin.message_del_failure');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';	
										
									}
								}
			break;
			case 'Classifywechat':
								$subcondition['topid']=$request->get('id');
								$subinfo=DB::table('classifywechats')->where($subcondition)->get();
								if($subinfo)
								{
									$msg_array['status']='0';
									$msg_array['info']=trans('admin.message_failure_delete_sub');
									$msg_array['is_reload']=0;
									$msg_array['curl']='';
									$msg_array['resource']='';
									$msg_array['param_way']='';
									$msg_array['param_keyword']='';	
								}
								else
								{
									$info=$this->delete_action('classifywechats',$request->get('id'));
									if($info)
									{
										$msg_array['status']='1';
										$msg_array['info']=trans('admin.message_del_success');
										$msg_array['is_reload']=0;
										$msg_array['curl']='';
										$msg_array['resource']='';
										$msg_array['param_way']='';
										$msg_array['param_keyword']='';
									}
									else
									{
										
										$msg_array['status']='0';
										$msg_array['info']=trans('admin.message_del_failure');
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
								$msg_array['info']=trans('admin.message_del_success');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';
							}
							else
							{
								
								$msg_array['status']='0';
								$msg_array['info']=trans('admin.message_del_failure');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';	
								
							}
			break;
			case 'Product':
							$info=$this->delete_action('products',$request->get('id'));
							if($info)
							{
								$msg_array['status']='1';
								$msg_array['info']=trans('admin.message_del_success');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';
							}
							else
							{
								
								$msg_array['status']='0';
								$msg_array['info']=trans('admin.message_del_failure');
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
								$msg_array['info']=trans('admin.message_del_success');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';
							}
							else
							{
								
								$msg_array['status']='0';
								$msg_array['info']=trans('admin.message_del_failure');
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
								$msg_array['info']=trans('admin.message_del_success');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';
							}
							else
							{
								
								$msg_array['status']='0';
								$msg_array['info']=trans('admin.message_del_failure');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';	
								
							}
			break;
			case 'Question':
							$rule=1;	
							DB::beginTransaction();
							try
							{ 
								$subinfo=$this->delete_action('questionoptions',$request->get('id'),'qid');
								if($subinfo)
								{
									$rule=1;
									DB::commit();
								}
								else
								{
									$rule=2;
									DB::rollBack();
								}
							}
							catch (\Exception $e) 
							{ 
								//接收异常处理并回滚
								$rule=2;
								DB::rollBack(); 
							}
							if($rule==1)
							{
								$info=$this->delete_action('questions',$request->get('id'));
								if($info)
								{
									$msg_array['status']='1';
									$msg_array['info']=trans('admin.message_del_success');
									$msg_array['is_reload']=0;
									$msg_array['curl']='';
									$msg_array['resource']='';
									$msg_array['param_way']='';
									$msg_array['param_keyword']='';
								}
								else
								{
									
									$msg_array['status']='0';
									$msg_array['info']=trans('admin.message_del_failure');
									$msg_array['is_reload']=0;
									$msg_array['curl']='';
									$msg_array['resource']='';
									$msg_array['param_way']='';
									$msg_array['param_keyword']='';	
									
								}
							}
							else
							{
								$msg_array['status']='0';
								$msg_array['info']=trans('admin.message_del_failure');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';
							}

			break;
			case 'Questionoption':
							$info=$this->delete_action('questionoptions',$request->get('id'));
							if($info)
							{
								$msg_array['status']='1';
								$msg_array['info']=trans('admin.message_del_success');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';
							}
							else
							{
								
								$msg_array['status']='0';
								$msg_array['info']=trans('admin.message_del_failure');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';	
								
							}
			break;
			case 'Wechatreplytext':
							$info=$this->delete_action('wechatreplytexts',$request->get('id'));
							if($info)
							{
								$subcondition['type']='text';
								$subcondition['tablename']='wechatreplytexts';
								$subcondition['field_id']=$request->get('id');

								$subinfo=DB::table('wechatkeywords')->where($subcondition)->delete();

								$msg_array['status']='1';
								$msg_array['info']=trans('admin.message_del_success');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';
							}
							else
							{
								
								$msg_array['status']='0';
								$msg_array['info']=trans('admin.message_del_failure');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';	
								
							}
			break;
			case 'Wechatreplyimagetext':
							$info=$this->delete_action('wechatreplyimagetexts',$request->get('id'));
							if($info)
							{
								$subcondition['type']='imagetext';
								$subcondition['tablename']='wechatreplyimagetexts';
								$subcondition['field_id']=$request->get('id');

								$subinfo=DB::table('wechatkeywords')->where($subcondition)->delete();

								$msg_array['status']='1';
								$msg_array['info']=trans('admin.message_del_success');
								$msg_array['is_reload']=0;
								$msg_array['curl']='';
								$msg_array['resource']='';
								$msg_array['param_way']='';
								$msg_array['param_keyword']='';
							}
							else
							{
								
								$msg_array['status']='0';
								$msg_array['info']=trans('admin.message_del_failure');
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
	public function delete_action($tablename,$id,$filed='id') 
	{
		$condition[$filed]=$id;
		$info=DB::table($tablename)->where($condition)->delete();//返回1;
		return $info;
	} 
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :批量删除操作
	*******************************************/
	public function delete_more_action($tablename,$ids,$filed='id') 
	{
		$condition[$filed]=$ids;
		$info=DB::table($tablename)->whereIn($condition)->delete();//返回;
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
						//如果你希望清除整张表，也就是删除所有列并将自增ID置为0	
						$info=DB::table('logs')->truncate();
			break;
		}
		if($info)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_clear_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$info;
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		}
		else
		{
			
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_clear_failure');
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
			case 'Classifyproduct':
				$params = Classifyproduct::find($request->get('id'));
				# code...
				break;	
			case 'Classifyquestion':
				$params = Classifyquestion::find($request->get('id'));
				# code...
				break;			
			case 'Article':
				$params = Article::find($request->get('id'));
				# code...
				break;
			case 'Product':
				$params = Product::find($request->get('id'));
				# code...
				break;	
			case 'Question':
				$params = Question::find($request->get('id'));
				# code...
				break;	
			case 'Questionoption':
				$params = Questionoption::find($request->get('id'));
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
			case 'Wechatreplyimagetext':
				$params = Wechatreplyimagetext::find($request->get('id'));
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
			$result=del_image_action($classname,$params['attachment']);
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
							$msg_array['param_way']='';
							$msg_array['param_keyword']='';
						} 
						else 
						{
							$msg_array['status']='0';
							$msg_array['info']=trans('admin.message_del_failure');
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
							$msg_array['info']=trans('admin.message_del_success');
							$msg_array['is_reload']=1;
							$msg_array['curl']='';
							$msg_array['resource']='';
							$msg_array['param_way']='';
							$msg_array['param_keyword']='';
						} 
						else 
						{
							$msg_array['status']='0';
							$msg_array['info']=trans('admin.message_del_failure');
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
			$msg_array['info']=trans('admin.message_del_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		}
		
		return response()->json($msg_array);
	}

}
