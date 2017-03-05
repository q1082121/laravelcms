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
		$website['cursitename']=trans('admin.website_navigation_wechat');
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_name'),'value'=>'name');
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
		$website['cursitename']=trans('admin.website_navigation_wechat');
		$website['waytype']=0;
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
		$website['cursitename']=trans('admin.website_navigation_wechat');
		$website['waytype']=1;
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
		$website['cursitename']=trans('admin.website_navigation_wechat');
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
		$params->subscribe_text 	= "您好！欢迎关注我,么么哒!";
		$params->default_text  		= "暂无内容,敬请期待！";
        $params->status		        = $request->get('status');
        $params->user_id		    = $this->user['id'];

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
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_add_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=route('get.admin.wechat');
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
		$info=object_array(DB::table('wechats')->where($condition)->first());
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
		$waytype=$request->get('waytype');
		switch($waytype)
		{
			case 1:
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
					$params->status		        = $request->get('status');

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
					$linkurl=route('get.admin.wechat');
			break;
			case 2:
					$params = Wechat::find($request->get('id'));
					$params->subscribe_text  	        = $request->get('subscribe_text');
					$params->subscribe_keyword  	    = $request->get('subscribe_keyword');
					$linkurl=route('get.admin.wechat.manage').'/'.$request->get('id');
			break;
			case 3:
					$params = Wechat::find($request->get('id'));
					$params->default_text   	    	= $request->get('default_text');
					$params->default_keyword  	    	= $request->get('default_keyword');
					$params->image_default_text   	    = $request->get('image_default_text');
					$params->image_default_keyword  	= $request->get('image_default_keyword');
					$params->voice_default_text   	    = $request->get('voice_default_text');
					$params->voice_default_keyword  	= $request->get('voice_default_keyword');
					$params->video_default_text   	    = $request->get('video_default_text');
					$params->video_default_keyword  	= $request->get('video_default_keyword');
					$linkurl=route('get.admin.wechat.manage').'/'.$request->get('id');
			break;
			case 4:
					$params = Wechat::find($request->get('id'));
					$params->openid_items		= $request->get('openid_items');
					$params->temp_name1		    = $request->get('temp_name1');
					$params->temp_id1		    = $request->get('temp_id1');
					$params->temp_name2		    = $request->get('temp_name2');
					$params->temp_id2		    = $request->get('temp_id2');
					$params->temp_name3		    = $request->get('temp_name3');
					$params->temp_id3		    = $request->get('temp_id3');
					$params->temp_name4		    = $request->get('temp_name4');
					$params->temp_id4		    = $request->get('temp_id4');
					$linkurl=route('get.admin.wechat.manage').'/'.$request->get('id');
			break;
		}
		if ($params->save()) 
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_save_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=$linkurl;
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
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :关注回复
	*******************************************/
	public function subscribe($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_subscribe_reply');
		$website['waytype']=2;
		$website['id']=$id;

		return view('admin/wechat/subscribe')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :默认回复
	*******************************************/
	public function defaultreply($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_default_reply');
		$website['waytype']=3;
		$website['id']=$id;

		return view('admin/wechat/defaultreply')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :模版消息
	*******************************************/
	public function messagetpl($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_messagetpl_reply');
		$website['waytype']=4;
		$website['id']=$id;
		return view('admin/wechat/messagetpl')->with('website',$website);
	}

}
