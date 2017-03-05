<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :属性分组
*******************************************/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Attributegroup;
use DB;
use URL;
use Cache;

class AttributegroupController extends PublicController
{
    //
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_attributegroup');
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_name'),'value'=>'name');
		$website['wayoption']=json_encode($wayoption);
		$website['modellist']=json_encode($this->fieldtype_modellist);
		$website['displaytypellist']=json_encode($this->displaytype_modellist);

		return view('admin/attributegroup/index')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加
	*******************************************/
	public function add()
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_attributegroup');
		$website['id']=0;
		$website['modellist']=json_encode($this->fieldtype_modellist);
		$website['displaytypellist']=json_encode($this->displaytype_modellist);
		$class_condition['status']=1;
		$class_condition['grade']=1;
		$classlist=object_array(DB::table('classifyproducts')->where($class_condition)->orderBy('id', 'desc')->get());
		$website['classlist']=$classlist;
		return view('admin/attributegroup/add')->with('website',$website);
	}
    /******************************************
	****AuThor : rubbish.boy@163.com
	****Title  : 编辑信息
	*******************************************/
	public function edit($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_attributegroup');
		$website['id']=$id;
		$website['modellist']=json_encode($this->fieldtype_modellist);
		$website['displaytypellist']=json_encode($this->displaytype_modellist);
		$class_condition['status']=1;
		$class_condition['grade']=1;
		$classlist=object_array(DB::table('classifyproducts')->where($class_condition)->orderBy('id', 'desc')->get());
		$website['classlist']=$classlist;
		return view('admin/attributegroup/add')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表接口
	*******************************************/
	public function api_list(Request $request)  
	{
		$search_field=$request->get('way')?$request->get('way'):'name';
		$keyword=$request->get('keyword');
		if($keyword)
		{
			$list=Attributegroup::where($search_field, 'like', '%'.$keyword.'%')->orderBy('orderid','asc')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=Attributegroup::orderBy('orderid','asc')->paginate($this->pagesize);
		}
		if($list && $list->total()>0)
		{
			$cache_classproduct= Cache::store('file')->get('classproduct');
			foreach($list as $key=>$val)
			{
				$list[$key]['groupclass']="";
				if($val['groupitems'])
				{
					$itemarr=explode(',',$val['groupitems']);
					$list[$key]['groupclass']="";
					foreach($itemarr as $subkey=>$subval)
					{
						$list[$key]['groupclass'].=($subkey==0?"":",").$cache_classproduct[str_replace("-", "", $subval)]['name'];
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

		$params = new Attributegroup;
		$params->name 			= $request->get('name');
		$params->display_name 	= $request->get('display_name');
		$params->type 			= $request->get('type');
		$params->display_type 	= $request->get('display_type');
		$params->groupitems 	= $request->get('groupitems')?implode(",", $request->get('groupitems')):'';
		$params->orderid		= $request->get('orderid');
		$params->status			= $request->get('status');
		$params->user_id		= $this->user['id'];

		if ($params->save()) 
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_add_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=route('get.admin.attributegroup');
			$msg_array['resource']='';
		} 
		else 
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_add_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
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
		$info=object_array(DB::table('attributegroups')->where($condition)->first());
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

		$params = Attributegroup::find($request->get('id'));
		$params->name 			= $request->get('name');
		$params->display_name 	= $request->get('display_name');
		$params->type 			= $request->get('type');
		$params->display_type 	= $request->get('display_type');
		$params->groupitems 	= $request->get('groupitems')?implode(",", $request->get('groupitems')):'';
		$params->orderid		= $request->get('orderid');
		$params->status			= $request->get('status');
		if ($params->save()) 
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_save_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=route('get.admin.attributegroup');
			$msg_array['resource']='';
		} 
		else 
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_save_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
		}
		return response()->json($msg_array);
	}
}
