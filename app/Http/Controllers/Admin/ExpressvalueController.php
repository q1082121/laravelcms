<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :费用管理
*******************************************/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Wechat;
use App\Http\Model\Expressvalue;
use App\Http\Model\Expresstemplate;
use DB;
use URL;
use Cache;

class ExpressvalueController extends PublicController
{
    //
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_expressvalue');
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_name'),'value'=>'name');
		$website['wayoption']=json_encode($wayoption);
		$info = object_array(DB::table('expresstemplates')->whereId($id)->first());
		$website['info']=$info;
		$website['expresstemplate_id']=$id;
		return view('admin/expressvalue/index')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加
	*******************************************/
	public function add($id)
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_expressvalue');
		$website['id']=0;
		$website['expresstemplate_id']=$id;

		$area_condition['level']=1;
		$area_condition['parentid']=0;
		$arealist=object_array(DB::table('districts')->where($area_condition)->get());
		$condition['expresstemplate_id']=$id;
		foreach($arealist as $key=>$val)
		{
			$ischeck=object_array(DB::table('expressvalues')->where($condition)->where('area_items', 'like', '%-'.$val['id'].'-%')->first());
			$arealist[$key]['ischeck']=$ischeck?1:0;
		}
		$website['arealist']=$arealist;

		return view('admin/expressvalue/add')->with('website',$website);
	}
    /******************************************
	****AuThor : rubbish.boy@163.com
	****Title  : 编辑信息
	*******************************************/
	public function edit($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_expressvalue');
		$website['id']=$id;
		$info = object_array(DB::table('expressvalues')->whereId($id)->first());
		$website['expresstemplate_id']=$info['expresstemplate_id'];

		$area_condition['level']=1;
		$area_condition['parentid']=0;
		$arealist=object_array(DB::table('districts')->where($area_condition)->get());

		$condition['expresstemplate_id']=$info['expresstemplate_id'];
		foreach($arealist as $key=>$val)
		{
			$ischeck=object_array(DB::table('expressvalues')->where('id', '!=' , $id)->where($condition)->where('area_items', 'like', '%-'.$val['id'].'-%')->first());
			$arealist[$key]['ischeck']=$ischeck?1:0;
		}
		$website['arealist']=$arealist;

		return view('admin/expressvalue/add')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表接口
	*******************************************/
	public function api_list(Request $request)  
	{
		$expresstemplate_id=$request->get('expresstemplate_id');
		$search_field=$request->get('way')?$request->get('way'):'name';
		$keyword=$request->get('keyword');
		if($keyword)
		{
			$list=expresstemplate::find($expresstemplate_id)->hasManyExpressvalues()->where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field,'expresstemplate_id'=>$expresstemplate_id])->links();
		}
		else
		{
			$list=expresstemplate::find($expresstemplate_id)->hasManyExpressvalues()->paginate($this->pagesize);
			$list->appends(['expresstemplate_id'=>$expresstemplate_id])->links();
		}
		if($list && $list->total()>0)
		{
			foreach($list as $key=>$val)
			{
				$list[$key]['arealist']="";
				$area_items=str_replace('-','',$val['area_items']);
				$area_items_arr=explode(',',$area_items);
				if($area_items_arr)
				{
					sort($area_items_arr);
					foreach($area_items_arr as $subkey=>$subval)
					{
						$info=object_array(DB::table('districts')->whereId($subval)->first());
						$list[$key]['arealist'].=($subkey==0?'':',').$info['alias'];
					}
				}

			}

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
			$params = new Expressvalue;
			$params->name 						= $request->get('name');
			$params->price 						= $request->get('price');
			$params->area_items 				= $request->get('area_items')?implode(",", $request->get('area_items')):'';
			$params->status						= $request->get('status');
			$params->user_id					= $this->user['id'];
			$params->expresstemplate_id 		= $request->get('expresstemplate_id');

			if ($params->save()) 
			{
				$msg_array['status']='1';
				$msg_array['info']=trans('admin.message_add_success');
				$msg_array['is_reload']=0;
				$msg_array['curl']=route('get.admin.expressvalue').'/'.$params->expresstemplate_id;
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
		$info=object_array(DB::table('expressvalues')->where($condition)->first());
		if($info)
		{
			$info['area_items']=explode(',',$info['area_items']);
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
			
			$params = Expressvalue::find($request->get('id'));
			$params->name 			= $request->get('name');
			$params->price 			= $request->get('price');
			$params->area_items 	= $request->get('area_items')?implode(",", $request->get('area_items')):'';
			$params->status			= $request->get('status');

			if ($params->save()) 
			{

				$msg_array['status']='1';
				$msg_array['info']=trans('admin.message_save_success');
				$msg_array['is_reload']=0;
				$msg_array['curl']=route('get.admin.expressvalue').'/'.$params->expresstemplate_id;
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
