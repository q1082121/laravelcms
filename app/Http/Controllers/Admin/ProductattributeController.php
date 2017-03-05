<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :价格属性管理
*******************************************/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Wechat;
use App\Http\Model\Product;
use App\Http\Model\Productattribute;
use DB;
use URL;
use Cache;

class ProductattributeController extends PublicController
{
    //
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_productattribute');
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_name'),'value'=>'name');
		$website['wayoption']=json_encode($wayoption);
		$info = object_array(DB::table('products')->whereId($id)->first());
		$website['info']=$info;
		$website['product_id']=$id;

		/**********************************************************/
		$cache_classproduct= Cache::store('file')->get('classproduct');
		$topinfo = object_array(DB::table('products')->whereId($id)->first());
		$bclassid=$cache_classproduct[$topinfo['classid']]['topid']==0?$cache_classproduct[$topinfo['classid']]['id']:$cache_classproduct[$topinfo['classid']]['topid'];
		$attributegroup_list=object_array(DB::table('attributegroups')->where('groupitems', 'like', '%-'.$bclassid.'-%')->orderby('orderid','asc')->get());
		$website['attributegroup_list']=$attributegroup_list;
		/**********************************************************/
		
		return view('admin/productattribute/index')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加
	*******************************************/
	public function add($id)
	{
		

		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_productattribute');
		$website['id']=0;
		$website['product_id']=$id;
		/**********************************************************/
		$cache_classproduct= Cache::store('file')->get('classproduct');
		$topinfo = object_array(DB::table('products')->whereId($id)->first());
		$bclassid=$cache_classproduct[$topinfo['classid']]['topid']==0?$cache_classproduct[$topinfo['classid']]['id']:$cache_classproduct[$topinfo['classid']]['topid'];
		$attributegroup_list=object_array(DB::table('attributegroups')->where('groupitems', 'like', '%-'.$bclassid.'-%')->orderby('orderid','asc')->get());
		
		if($attributegroup_list)
		{
			foreach($attributegroup_list as $key=>$val)
			{
				$subcondition['attributegroup_id']=$val['id'];
				$attributegroup_list[$key]['sublist']=object_array(DB::table('attributevalues')->where($subcondition)->orderby('orderid','asc')->get());
			}
		}
		$website['attributegroup_list']=$attributegroup_list;
		/**********************************************************/

		return view('admin/productattribute/add')->with('website',$website);
	}
    /******************************************
	****AuThor : rubbish.boy@163.com
	****Title  : 编辑信息
	*******************************************/
	public function edit($id)  
	{
		

		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_productattribute');
		$website['id']=$id;
		$info = object_array(DB::table('productattributes')->whereId($id)->first());
		$website['product_id']=$info['product_id'];

		/**********************************************************/
		$cache_classproduct= Cache::store('file')->get('classproduct');
		$topinfo = object_array(DB::table('products')->whereId($info['product_id'])->first());
		$bclassid=$cache_classproduct[$topinfo['classid']]['topid']==0?$cache_classproduct[$topinfo['classid']]['id']:$cache_classproduct[$topinfo['classid']]['topid'];
		$attributegroup_list=object_array(DB::table('attributegroups')->where('groupitems', 'like', '%-'.$bclassid.'-%')->orderby('orderid','asc')->get());
		
		if($attributegroup_list)
		{
			foreach($attributegroup_list as $key=>$val)
			{
				$subcondition['attributegroup_id']=$val['id'];
				$attributegroup_list[$key]['sublist']=object_array(DB::table('attributevalues')->where($subcondition)->orderby('orderid','asc')->get());
			}
		}
		$website['attributegroup_list']=$attributegroup_list;
		/**********************************************************/


		return view('admin/productattribute/add')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表接口
	*******************************************/
	public function api_list(Request $request)  
	{
		$product_id=$request->get('product_id');
		$search_field=$request->get('way')?$request->get('way'):'name';
		$keyword=$request->get('keyword');
		if($keyword)
		{
			$list=Product::find($product_id)->hasManyProductattributes()->where($search_field, 'like', '%'.$keyword.'%')->orderby('orderid','asc')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field,'product_id'=>$product_id])->links();
		}
		else
		{
			$list=Product::find($product_id)->hasManyProductattributes()->orderby('orderid','asc')->paginate($this->pagesize);
			$list->appends(['product_id'=>$product_id])->links();
		}
		if($list && $list->total()>0)
		{

			foreach($list as $key=>$val)
			{
				$subcondition['productattribute_id']=$val['id'];
				$subcondition['product_id']=$val['product_id'];
				$sublist=object_array(DB::table('productattributegroupvalues')->where($subcondition)->get());
				if($sublist)
				{
					foreach($sublist as $subkey=>$subval)
					{	
						$groupcondition['name']=$subval['keyname'];
						$grouptype=object_array(DB::table('attributegroups')->where($groupcondition)->first());
						if($grouptype['type']=="radio")
						{
							$valuecondition['id']=str_replace("-",'',$subval['keyval']);
							$valuename=object_array(DB::table('attributevalues')->where($valuecondition)->first());
							$keydisplay_name=$valuename['name'];
						}
						else if($grouptype['type']=="text")
						{
							$keydisplay_name=$subval['keyval'];
						}
						
						$list[$key][$subval['keyname']]=$keydisplay_name;
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
			$params = new Productattribute;
			$params->name 			= $request->get('name');
			$params->price 			= $request->get('price');
			$params->amount 		= $request->get('amount');
			$params->orderid		= $request->get('orderid');
			$params->status			= $request->get('status');
			$params->user_id		= $this->user['id'];
			$params->product_id 	= $request->get('product_id');

			//图片上传处理接口
			$attachment='attachment';
			$data_image=$request->get($attachment);
			if($data_image)
			{
				//上传文件归类：获取控制器名称
				$classname=getCurrentControllerName();
				$params->attachment=uploads_action($classname,$data_image,$this->thumb_width,$this->thumb_height,$this->is_thumb,$this->is_watermark,$this->root);
				$params->isattach=1;
			}

			if ($params->save()) 
			{
				/**********************************************************/
				$cache_classproduct= Cache::store('file')->get('classproduct');
				$topinfo = object_array(DB::table('products')->whereId($params->product_id)->first());
				$bclassid=$cache_classproduct[$topinfo['classid']]['topid']==0?$cache_classproduct[$topinfo['classid']]['id']:$cache_classproduct[$topinfo['classid']]['topid'];
				$attributegroup_list=object_array(DB::table('attributegroups')->where('groupitems', 'like', '%-'.$bclassid.'-%')->orderby('orderid','asc')->get());

				if($attributegroup_list)
				{
					foreach($attributegroup_list as $key=>$val)
					{
						$subparam['productattribute_id']=$params->id;
						$subparam['product_id']=$params->product_id;
						$subparam['keyname']=$val['name'];
						$subparam['keyval']=$request->get($val['name']);
						DB::table('productattributegroupvalues')->insert($subparam);
					}
				}
				/**********************************************************/

				$msg_array['status']='1';
				$msg_array['info']=trans('admin.message_add_success');
				$msg_array['is_reload']=0;
				$msg_array['curl']=route('get.admin.productattribute').'/'.$params->product_id;
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
		$info=object_array(DB::table('productattributes')->where($condition)->first());
		if($info)
		{
			$subcondition['productattribute_id']=$condition['id'];
			$subcondition['product_id']=$info['product_id'];
			$sublist=object_array(DB::table('productattributegroupvalues')->where($subcondition)->get());
			if($sublist)
			{
				foreach($sublist as $key=>$val)
				{
					$info[$val['keyname']]=$val['keyval'];
				}
			}

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
			
			$params = Productattribute::find($request->get('id'));
			$params->name 			= $request->get('name');
			$params->price 			= $request->get('price');
			$params->amount 		= $request->get('amount');
			$params->orderid		= $request->get('orderid');
			$params->status			= $request->get('status');

			//图片上传处理接口
			$attachment='attachment';
			$data_image=$request->get($attachment);
			if($data_image)
			{
				//上传文件归类：获取控制器名称
				$classname=getCurrentControllerName();
				$params->attachment=uploads_action($classname,$data_image,$this->thumb_width,$this->thumb_height,$this->is_thumb,$this->is_watermark,$this->root);
				$params->isattach=1;
			}

			if ($params->save()) 
			{
				/**********************************************************/
				$cache_classproduct= Cache::store('file')->get('classproduct');
				$topinfo = object_array(DB::table('products')->whereId($params->product_id)->first());
				$bclassid=$cache_classproduct[$topinfo['classid']]['topid']==0?$cache_classproduct[$topinfo['classid']]['id']:$cache_classproduct[$topinfo['classid']]['topid'];
				$attributegroup_list=object_array(DB::table('attributegroups')->where('groupitems', 'like', '%-'.$bclassid.'-%')->orderby('orderid','asc')->get());

				if($attributegroup_list)
				{
					$subcondition['productattribute_id']=$params->id;
					$subcondition['product_id']=$params->product_id;
					DB::table('productattributegroupvalues')->where($subcondition)->delete();
					foreach($attributegroup_list as $key=>$val)
					{
						$subparam['productattribute_id']=$params->id;
						$subparam['product_id']=$params->product_id;
						$subparam['keyname']=$val['name'];
						$subparam['keyval']=$request->get($val['name']);
						DB::table('productattributegroupvalues')->insert($subparam);
					}
					
				}
				/**********************************************************/

				$msg_array['status']='1';
				$msg_array['info']=trans('admin.message_save_success');
				$msg_array['is_reload']=0;
				$msg_array['curl']=route('get.admin.productattribute').'/'.$params->product_id;
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
