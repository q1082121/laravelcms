<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :微信菜单分类
*******************************************/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Wechat;
use App\Http\Model\Classifywechat;
use DB;
use URL;
use App\Common\lib\Cates; 

class ClassifywechatController extends PublicController
{
    //
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_wechat_menu');
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_name'),'value'=>'name');
		$wayoption[]=array('text'=>trans('admin.fieldname_item_keyword'),'value'=>'keyword');
		$website['wayoption']=json_encode($wayoption);
		$website['modellist']=$this->wechat_menutype;
		$info = object_array(DB::table('wechats')->whereId($id)->first());
		$website['info']=$info;
		$website['wechat_id']=$id;

		return view('admin/classifywechat/index')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加
	*******************************************/
	public function add($id)
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_wechat_menu');
		$website['id']=0;
		$website['wechat_id']=$id;
		$website['modellist']=json_encode($this->wechat_menutype);
		$condition['wechat_id']=$website['wechat_id'];
		$list=object_array(DB::table('classifywechats')->where($condition)->orderBy('id', 'desc')->get());
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

		return view('admin/classifywechat/add')->with('website',$website);
	}
	/******************************************
	****AuThor : rubbish.boy@163.com
	****Title  : 编辑信息
	*******************************************/
	public function edit($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_wechat_menu');
		$website['id']=$id;
		$website['modellist']=json_encode($this->wechat_menutype);
		$info = object_array(DB::table('classifywechats')->whereId($id)->first());
		$website['wechat_id']=$info['wechat_id'];
		$condition['wechat_id']=$website['wechat_id'];
		$list=object_array(DB::table('classifywechats')->where($condition)->orderBy('id', 'desc')->get());
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
		return view('admin/classifywechat/add')->with('website',$website);
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
			$list=Wechat::find($wechat_id)->hasManyClassifywechats()->where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field,'wechat_id'=>$wechat_id])->links();
		}
		else
		{
			$list=Wechat::find($wechat_id)->hasManyClassifywechats()->paginate($this->pagesize);
			$list->appends(['wechat_id'=>$wechat_id])->links();
		}
		if($list && $list->total()>0)
		{
			$cates=new Cates();
			$cates->opt($list);
			$classoptlist = $cates->optlist;
			/*
			$list['cates']=$classoptlist;
			*/
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

		$params = new Classifywechat;
		$params->topid 		= $request->get('topid');
		$params->type 		= $request->get('type');
		$params->name 		= $request->get('name');
		$params->keyword 	= $request->get('keyword');
		$params->ico 		= $request->get('ico');
		$params->orderid	= $request->get('orderid');
		$params->linkurl 	= $request->get('linkurl');
		$params->wechat_id 	= $request->get('wechat_id');
		$params->status		= $request->get('status');
		
		if($params->topid == 0)
		{
			$params->grade=1;
		}
		else
		{
			$info=Classifywechat::find($params->topid);
			$params->grade=$info['grade']+1;	
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
					$params->node= $info['node'].','.$params->id;
				}
				$params->scid=$params->id;
			}
			$params->save();

			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_add_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=route('get.admin.classifywechat').'/'.$params->wechat_id;
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
		$info=object_array(DB::table('classifywechats')->where($condition)->first());
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

		$params = Classifywechat::find($request->get('id'));
		$params->topid 		= $request->get('topid');
		$params->type 		= $request->get('type');
		$params->name 		= $request->get('name');
		$params->keyword 	= $request->get('keyword');
		$params->ico 		= $request->get('ico');
		$params->orderid	= $request->get('orderid');
		$params->linkurl 	= $request->get('linkurl');
		$params->status		= $request->get('status');

		if($params->topid==0)
		{
			$params->grade=1;
			$params->node= '';
			$params->bcid=$request->get('id');
		}
		else
		{
			$info=Classifywechat::find($params->topid);
			$params->grade=$info['grade']+1;	

			$params->bcid=$params->topid;	

			if($params->grade==2)
			{
				$params->node=$params->topid.','.$params->id;
			}
			else
			{
				$params->node= $info['node'].','.$params->id;
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
			$msg_array['info']=trans('admin.message_save_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=route('get.admin.classifywechat').'/'.$params->wechat_id;
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
