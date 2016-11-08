<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :微信公众号
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\Wechat;
use DB;
use URL;
class WechatController extends PublicController
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
		$website['cursitename']=trans('admin.website_navigation_nine');
		$website['apiurl_list']=URL::action('Admin\WechatController@api_list');
		$website['apiurl_one_action']=URL::action('Admin\OneactionapiController@api_one_action');
		$website['link_add']=URL::action('Admin\WechatController@add');
		$website['link_edit']=route('get.admin.wechat.edit').'/';
		$website['link_manage']=route('get.admin.wechat.manage').'/';
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.website_wechat_item_name'),'value'=>'name');
		$website['wayoption']=json_encode($wayoption);
		
		return view('admin/wechat/index')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加
	*******************************************/
	public function add()
	{
		$website=$this->website;
        $website['modelname']=getCurrentControllerName();
		$website['cursitename']=trans('admin.website_navigation_nine');
		$website['apiurl_add']=URL::action('Admin\WechatController@api_add');
		$website['apiurl_info']=URL::action('Admin\WechatController@api_info');
		$website['apiurl_edit']=URL::action('Admin\WechatController@api_edit');
		$website['apiurl_del_image']=URL::action('Admin\DeleteapiController@api_del_image');
		$website['id']=0;
        $website['modellist']=json_encode($this->wechat_modellist);
		
		return view('admin/wechat/add')->with('website',$website);
	}
    /******************************************
	****AuThor : rubbish.boy@163.com
	****Title  : 编辑信息
	*******************************************/
	public function edit($id)  
	{
		$website=$this->website;
        $website['modelname']=getCurrentControllerName();
		$website['cursitename']=trans('admin.website_navigation_nine');
		$website['apiurl_add']=URL::action('Admin\WechatController@api_add');
		$website['apiurl_info']=URL::action('Admin\WechatController@api_info');
		$website['apiurl_edit']=URL::action('Admin\WechatController@api_edit');
		$website['apiurl_del_image']=URL::action('Admin\DeleteapiController@api_del_image');
		$website['id']=$id;
		$website['modellist']=json_encode($this->wechat_modellist);

		return view('admin/wechat/add')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :管理中心
	*******************************************/
	public function manage($id)  
	{
		$website=$this->website;
        $website['modelname']=getCurrentControllerName();
		$website['cursitename']=trans('admin.website_navigation_nine');
		$website['link_subscribe']=route('get.admin.wechat.subscribe').'/'.$id;
		$website['link_default']=route('get.admin.wechat.default').'/'.$id;
		$website['link_text']=route('get.admin.wechat.text').'/'.$id;
		$website['link_imagetext']=route('get.admin.wechat.imagetext').'/'.$id;
		$website['link_menu']=route('get.admin.wechat.menu').'/'.$id;
		$website['link_user']=route('get.admin.wechat.user').'/'.$id;

		$info = object_array(DB::table('wechats')->whereId($id)->first());
		$website['info']=$info;
		$website['id']=$id;
		return view('admin/wechat/manage')->with('website',$website);
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
			$list=Wechat::where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=Wechat::paginate($this->pagesize);
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

		$params = new Wechat;
		$params->token 	            = $request->get('token');
		$params->name 	            = $request->get('name');
		$params->wechataccount 		= $request->get('wechataccount');
		$params->gid	            = $request->get('gid');
		$params->type	            = $request->get('type');
		$params->appid		        = $request->get('appid');
        $params->appsecret		    = $request->get('appsecret');
        $params->encodingaeskey		= $request->get('encodingaeskey');
        $params->mchid		        = $request->get('mchid');
        $params->paykey		        = $request->get('paykey');
        $params->openid_items		= $request->get('openid_items');
        $params->temp_name1		    = $request->get('temp_name1');
        $params->temp_id1		    = $request->get('temp_id1');
        $params->temp_name2		    = $request->get('temp_name2');
        $params->temp_id2		    = $request->get('temp_id2');
        $params->temp_name3		    = $request->get('temp_name3');
        $params->temp_id3		    = $request->get('temp_id3');
        $params->temp_name4		    = $request->get('temp_name4');
        $params->temp_id4		    = $request->get('temp_id4');
        $params->status		        = $request->get('status');
        $params->user_id		    = $this->user['id'];

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
			$msg_array['curl']=URL::action('Admin\WechatController@index');
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
		$info=DB::table('wechats')->where($condition)->first();
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

		$params = Wechat::find($request->get('id'));
		$params->token 	            = $request->get('token');
		$params->name 	            = $request->get('name');
		$params->wechataccount 		= $request->get('wechataccount');
		$params->gid	            = $request->get('gid');
		$params->type	            = $request->get('type');
		$params->appid		        = $request->get('appid');
        $params->appsecret		    = $request->get('appsecret');
        $params->encodingaeskey		= $request->get('encodingaeskey');
        $params->mchid		        = $request->get('mchid');
        $params->paykey		        = $request->get('paykey');
        $params->openid_items		= $request->get('openid_items');
        $params->temp_name1		    = $request->get('temp_name1');
        $params->temp_id1		    = $request->get('temp_id1');
        $params->temp_name2		    = $request->get('temp_name2');
        $params->temp_id2		    = $request->get('temp_id2');
        $params->temp_name3		    = $request->get('temp_name3');
        $params->temp_id3		    = $request->get('temp_id3');
        $params->temp_name4		    = $request->get('temp_name4');
        $params->temp_id4		    = $request->get('temp_id4');
        $params->status		        = $request->get('status');

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
			$msg_array['curl']=URL::action('Admin\WechatController@index');
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
