<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :友情链接
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\Link;
use DB;
//使用URL生成地址
use URL;

class LinkController extends PublicController
{
    //
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index()  
	{
		$website=$this->website;
        $website['modelname']=getCurrentControllerName();
		$website['cursitename']=trans('admin.website_navigation_eight');
		$website['apiurl_list']=URL::action('Admin\LinkController@api_list');
		$website['apiurl_one_action']=URL::action('Admin\OneactionapiController@api_one_action');
		$website['apiurl_delete']=URL::action('Admin\DeleteapiController@api_delete');
		$website['apiurl_cache']=URL::action('Admin\CacheapiController@api_cache');
		$website['link_add']=URL::action('Admin\LinkController@add');
		$website['link_edit']='/admin/link/edit/';
		$website['way']='title';
		$wayoption[]=array('text'=>trans('admin.website_link_item_title'),'value'=>'title');
		$website['wayoption']=json_encode($wayoption);
		$website['modellist']=$this->link_modellist;
		

		return view('admin/link/index')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加
	*******************************************/
	public function add()
	{
		$website=$this->website;
        $website['modelname']=getCurrentControllerName();
		$website['cursitename']=trans('admin.website_navigation_eight');
		$website['apiurl_add']=URL::action('Admin\LinkController@api_add');
		$website['apiurl_info']=URL::action('Admin\LinkController@api_info');
		$website['apiurl_edit']=URL::action('Admin\LinkController@api_edit');
		$website['apiurl_del_image']=URL::action('Admin\DeleteapiController@api_del_image');
		$website['id']=0;
		$website['modellist']=json_encode($this->link_modellist);
		

		return view('admin/link/add')->with('website',$website);
	}
    /******************************************
	****AuThor : rubbish.boy@163.com
	****Title  : 编辑信息
	*******************************************/
	public function edit($id)  
	{
		$website=$this->website;
        $website['modelname']=getCurrentControllerName();
		$website['cursitename']=trans('admin.website_navigation_eight');
		$website['apiurl_add']=URL::action('Admin\LinkController@api_add');
		$website['apiurl_info']=URL::action('Admin\LinkController@api_info');
		$website['apiurl_edit']=URL::action('Admin\LinkController@api_edit');
		$website['apiurl_del_image']=URL::action('Admin\DeleteapiController@api_del_image');
		$website['id']=$id;
		$website['modellist']=json_encode($this->link_modellist);

		return view('admin/link/add')->with('website',$website);
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
			$list=Link::where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=Link::paginate($this->pagesize);
		}
		if($list)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_get_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$list;
			$msg_array['param_way']=$search_field;
			$msg_array['param_keyword']=$keyword;
		}
		else
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_get_empty');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']=$search_field;
			$msg_array['param_keyword']=$keyword;
		}
        return response()->json($msg_array);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加接口
	*******************************************/
	public function api_add(Request $request)  
	{

		$params = new Link;
		$params->modelid 	= $request->get('modelid');
		$params->title 		= $request->get('title');
		$params->orderid	= $request->get('orderid');
		$params->linkurl	= $request->get('linkurl');
		$params->status		= $request->get('status');

		//图片上传处理接口
		$attachment='attachment';
		$data_image=$request->get($attachment);
		if($data_image)
		{
			//上传文件归类：获取控制器名称
			$classname=getCurrentControllerName();
			$params->attachment=$this->uploads_action($classname,$data_image);
			$params->isattach=1;
		}

		if ($params->save()) 
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_add_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=URL::action('Admin\LinkController@index');
			$msg_array['resource']='';
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		} 
		else 
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.website_add_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';	

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
		$info=DB::table('links')->where($condition)->first();
		if($info)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_get_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$info;
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.website_get_empty');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
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

		$params = Link::find($request->get('id'));
		$params->modelid 	= $request->get('modelid');
		$params->title 		= $request->get('title');
		$params->orderid	= $request->get('orderid');
		$params->linkurl	= $request->get('linkurl');
		$params->status		= $request->get('status');

		//图片上传处理接口
		$attachment='attachment';
		$data_image=$request->get($attachment);
		if($data_image)
		{
			//上传文件归类：获取控制器名称
			$classname=getCurrentControllerName();
			$params->attachment=$this->uploads_action($classname,$data_image);
			$params->isattach=1;
		}

		if ($params->save()) 
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_save_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=URL::action('Admin\LinkController@index');
			$msg_array['resource']='';
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		} 
		else 
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.website_save_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';	
		}
		return response()->json($msg_array);
	}
}
