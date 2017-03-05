<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :文本回复
*******************************************/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Wechat;
use App\Http\Model\Wechatreplytext;
use App\Http\Model\Wechatkeyword;
use DB;
use URL;
use Cache;

class WechatreplytextController extends PublicController
{
    //
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_text_reply');
		$website['way']='keyword';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_keyword'),'value'=>'keyword');
		$wayoption[]=array('text'=>trans('admin.fieldname_item_content'),'value'=>'content');
		$website['wayoption']=json_encode($wayoption);
		$info = object_array(DB::table('wechats')->whereId($id)->first());
		$website['info']=$info;
		$website['wechat_id']=$id;
		return view('admin/wechatreplytext/index')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加
	*******************************************/
	public function add($id)
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_text_reply');
		$website['id']=0;
		$website['wechat_id']=$id;
		return view('admin/wechatreplytext/add')->with('website',$website);
	}
    /******************************************
	****AuThor : rubbish.boy@163.com
	****Title  : 编辑信息
	*******************************************/
	public function edit($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_text_reply');
		$website['id']=$id;
		$info = object_array(DB::table('wechatreplytexts')->whereId($id)->first());
		$website['wechat_id']=$info['wechat_id'];

		return view('admin/wechatreplytext/add')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表接口
	*******************************************/
	public function api_list(Request $request)  
	{
		$wechat_id=$request->get('wechat_id');
		$search_field=$request->get('way')?$request->get('way'):'name';
		$keyword=$request->get('keyword');
		if($keyword)
		{
			$list=Wechat::find($wechat_id)->hasManyWechatreplytexts()->where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field,'wechat_id'=>$wechat_id])->links();
		}
		else
		{
			$list=Wechat::find($wechat_id)->hasManyWechatreplytexts()->paginate($this->pagesize);
			$list->appends(['wechat_id'=>$wechat_id])->links();
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
		DB::beginTransaction();
		try
		{ 
			
			$params = new Wechatreplytext;
			$params->keyword 	= $request->get('keyword');
			$params->content	= $request->get('content');
			$params->status		= $request->get('status');
			$params->wechat_id 	= $request->get('wechat_id');

			if ($params->save()) 
			{
				$subdatas['type'] 				="text";
				$subdatas['tablename']			= "wechatreplytexts";
				$subdatas['field_id']			= $params->id;
				$subdatas['field_keyword'] 		= $params->keyword;
				$subdatas['wechat_id'] 			= $params->wechat_id;
				$sub_action=in_wechat_keyword($subdatas);
				if ($sub_action) 
				{
					$msg_array['status']='1';
					$msg_array['info']=trans('admin.message_add_success');
					$msg_array['is_reload']=0;
					$msg_array['curl']=route('get.admin.wechatreplytext').'/'.$params->wechat_id;
					$msg_array['resource']='';
					DB::commit();
				}
				else
				{
					$msg_array['status']='0';
					$msg_array['info']=trans('admin.message_add_failure');
					$msg_array['is_reload']=0;
					$msg_array['curl']='';
					$msg_array['resource']="";
					DB::rollBack();
				}

			} 
			else 
			{
				
				$msg_array['status']='0';
				$msg_array['info']=trans('admin.message_add_failure');
				$msg_array['is_reload']=0;
				$msg_array['curl']='';
				$msg_array['resource']="";
				DB::rollBack();
			}
		}
		catch (\Exception $e) 
		{ 
			//接收异常处理并回滚
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_add_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";

			DB::rollBack(); 
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
		$info=object_array(DB::table('wechatreplytexts')->where($condition)->first());
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

		DB::beginTransaction();
		try
		{ 
			
			$params = Wechatreplytext::find($request->get('id'));
			$params->keyword 	= $request->get('keyword');
			$params->content	= $request->get('content');
			$params->status		= $request->get('status');

			if ($params->save()) 
			{
				$condition['type'] 				="text";
				$condition['tablename']			= "wechatreplytexts";
				$condition['wechat_id'] 		=$params->wechat_id;
				$condition['field_id'] 			=$params->id;

				$subinfo=object_array(DB::table('wechatkeywords')->where($condition)->first());

				$subparams = Wechatkeyword::find($subinfo['id']);
				$subparams->field_keyword=$params->keyword;

				if ($subparams->save()) 
				{
					$msg_array['status']='1';
					$msg_array['info']=trans('admin.message_save_success');
					$msg_array['is_reload']=0;
					$msg_array['curl']=route('get.admin.wechatreplytext').'/'.$params->wechat_id;
					$msg_array['resource']='';
					DB::commit();
				}
				else
				{
					$msg_array['status']='0';
					$msg_array['info']=trans('admin.message_save_failure');
					$msg_array['is_reload']=0;
					$msg_array['curl']='';
					$msg_array['resource']="";
					DB::rollBack();
				}

			} 
			else 
			{
				$msg_array['status']='0';
				$msg_array['info']=trans('admin.message_save_failure');
				$msg_array['is_reload']=0;
				$msg_array['curl']='';
				$msg_array['resource']="";
				DB::rollBack();
			}
		}
		catch (\Exception $e) 
		{ 
			//接收异常处理并回滚
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_save_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";	

			DB::rollBack(); 
		}
		return response()->json($msg_array);
	}
}
