<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :文章分类
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\Classify;
use DB;
use URL;
use App\Common\lib\Cates; 

class ClassifyController extends PublicController
{
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['modelname']=getCurrentControllerName();
		$website['cursitename']=trans('admin.website_navigation_classify');
		$website['apiurl_list']=URL::action('Admin\ClassifyController@api_list');
		$website['apiurl_one_action']=URL::action('Admin\OneactionapiController@api_one_action');
		$website['apiurl_delete']=URL::action('Admin\DeleteapiController@api_delete');
		$website['apiurl_cache']=URL::action('Admin\CacheapiController@api_cache');
		$website['link_add']=URL::action('Admin\ClassifyController@add');
		$website['link_edit']=route('get.admin.classify.edit').'/';
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.website_classify_item_name'),'value'=>'name');
		$website['wayoption']=json_encode($wayoption);

		return view('admin/classify/index')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加
	*******************************************/
	public function add()
	{
		$website=$this->website;
		$website['modelname']=getCurrentControllerName();
		$website['cursitename']=trans('admin.website_navigation_classify');
		$website['apiurl_add']=URL::action('Admin\ClassifyController@api_add');
		$website['apiurl_info']=URL::action('Admin\ClassifyController@api_info');
		$website['apiurl_edit']=URL::action('Admin\ClassifyController@api_edit');
		$website['apiurl_del_image']=URL::action('Admin\DeleteapiController@api_del_image');
		$website['id']=0;
		
		$list=object_array(DB::table('classifies')->where('status','=','1')->orderBy('id', 'desc')->get());
		if($list)
		{
			$cates=new Cates();
			$cates->opt($list);
			$classopts = $cates->opt;
			$classoptsdata = $cates->optdata;
			$website['classlist']=json_encode($classoptsdata);
		}
		else
		{
			$classlist[]=array('text'=>trans('admin.website_select_default'),'value'=>'0');
			$website['classlist']=json_encode($classlist);
		}

		return view('admin/classify/add')->with('website',$website);
	}
	/******************************************
	****AuThor : rubbish.boy@163.com
	****Title  : 编辑信息
	*******************************************/
	public function edit($id)  
	{
		$website=$this->website;
		$website['modelname']=getCurrentControllerName();
		$website['cursitename']=trans('admin.website_navigation_classify');
		$website['apiurl_add']=URL::action('Admin\ClassifyController@api_add');
		$website['apiurl_info']=URL::action('Admin\ClassifyController@api_info');
		$website['apiurl_edit']=URL::action('Admin\ClassifyController@api_edit');
		$website['apiurl_del_image']=URL::action('Admin\DeleteapiController@api_del_image');
		$website['id']=$id;

		$list=object_array(DB::table('classifies')->where('status','=','1')->orderBy('id', 'desc')->get());
		if($list)
		{
			$cates=new Cates();
			$cates->opt($list);
			$classopts = $cates->opt;
			$classoptsdata = $cates->optdata;
			$website['classlist']=json_encode($classoptsdata);
		}
		else
		{
			$classlist[]=array('text'=>trans('admin.website_select_default'),'value'=>'0');
			$website['classlist']=json_encode($classlist);
		}
		return view('admin/classify/add')->with('website',$website);
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
			$list=Classify::where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=Classify::paginate($this->pagesize);
			
		}
		if($list)
		{
			$cates=new Cates();
			$cates->opt($list);
			$classoptlist = $cates->optlist;
			$list['cates']=$classoptlist;

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

		$params = new Classify;
		$params->topid 		= $request->get('topid');
		$params->name 		= $request->get('name');
		$params->orderid	= $request->get('orderid');
		$params->linkurl	= $request->get('linkurl');
		$params->navflag	= $request->get('navflag');
		$params->perpage	= $request->get('perpage');
		$params->status		= $request->get('status');
		$params->user_id	= $this->user['id'];
		
		if($params->topid == 0)
		{
			$params->grade=1;
		}
		else
		{
			$classify_info=Classify::find($params->topid);
			$params->grade=$classify_info['grade']+1;	
		}

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
			

			if($params->topid ==0 && $params->grade==1)
			{ 
					$params->node='';
					$params->bcid=$params->id;
			}
			else
			{
				$params->bcid=$params->topid;
				if($params->grade==2)
				{
					$params->node=$params->topid.','.$params->id;
				}
				else
				{
					$params->node= $classify_info['node'].','.$params->id;
				}
				$params->scid=$params->id;
			}
			$params->save();

			$msg_array['status']='1';
			$msg_array['info']=trans('admin.website_add_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=URL::action('Admin\ClassifyController@index');
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
		$info=DB::table('classifies')->where($condition)->first();
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

		$params = Classify::find($request->get('id'));
		$params->topid 		= $request->get('topid');
		$params->name 		= $request->get('name');
		$params->orderid	= $request->get('orderid');
		$params->linkurl	= $request->get('linkurl');
		$params->navflag	= $request->get('navflag');
		$params->perpage	= $request->get('perpage');
		$params->status		= $request->get('status');

		if($params->topid==0)
		{
			$params->grade=1;
			$params->node= '';
			$params->bcid=$request->get('id');
		}
		else
		{
			$classify_info=Classify::find($params->topid);
			$params->grade=$classify_info['grade']+1;	

			$params->bcid=$params->topid;	

			if($params->grade==2)
			{
				$params->node=$params->topid.','.$params->id;
			}
			else
			{
				$params->node= $classify_info['node'].','.$params->id;
			}
			$params->scid=$params->id;	
		}

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
			$msg_array['curl']=URL::action('Admin\ClassifyController@index');
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
