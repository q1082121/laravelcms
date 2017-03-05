<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :微信小程序
*******************************************/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Xcxmp;
use DB;
use URL;
use Vinkla\Hashids\Facades\Hashids;

class XcxmpController extends PublicController
{
    //
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_xcxmp');
		$website['way']='name';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_name'),'value'=>'name');
		$website['wayoption']=json_encode($wayoption);
		
		return view('admin/xcxmp/index')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加
	*******************************************/
	public function add()
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_xcxmp');
		$website['waytype']=0;
		$website['id']=0;
		
		return view('admin/xcxmp/add')->with('website',$website);
	}
    /******************************************
	****AuThor : rubbish.boy@163.com
	****Title  : 编辑信息
	*******************************************/
	public function edit($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_xcxmp');
		$website['waytype']=1;
		$website['id']=$id;

		return view('admin/xcxmp/add')->with('website',$website);
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
			$list=Xcxmp::where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=Xcxmp::paginate($this->pagesize);
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

		$params = new Xcxmp;
		$params->token 	            = $request->get('token');
		$params->name 	            = $request->get('name');
		$params->appid		        = $request->get('appid');
        $params->appsecret		    = $request->get('appsecret');
		$params->mapkey		        = $request->get('mapkey');
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

		if ($params->save()) 
		{
			$id=$params->id;
			$params->token  =Hashids::encode($id.rand(10000000,99999999));
			$params->save();

			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_add_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=route('get.admin.xcxmp');
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
		$info=object_array(DB::table('xcxmps')->where($condition)->first());
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
					$params = Xcxmp::find($request->get('id'));
					$params->name 	            = $request->get('name');
					$params->appid		        = $request->get('appid');
					$params->appsecret		    = $request->get('appsecret');
					$params->mapkey		        = $request->get('mapkey');
					$params->mchid		        = $request->get('mchid');
					$params->paykey		        = $request->get('paykey');
					$params->status		        = $request->get('status');

					$linkurl=route('get.admin.xcxmp');
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

}
