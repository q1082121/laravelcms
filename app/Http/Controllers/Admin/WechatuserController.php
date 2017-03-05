<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :微信(会员粉丝)
*******************************************/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Wechat;
use App\Http\Model\Wechatuser;
use DB;
use URL;
use Cache;

class WechatuserController extends PublicController
{
    //
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index($id)  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_wechat_user');
		$website['link_back']=route('get.admin.wechat.manage').'/'.$id;
		$website['way']='nickname';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_nick'),'value'=>'nickname');
		$website['wayoption']=json_encode($wayoption);
		$info = object_array(DB::table('wechats')->whereId($id)->first());
		$website['info']=$info;
		$website['wechat_id']=$id;
		return view('admin/wechatuser/index')->with('website',$website);
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
			$list=Wechat::find($wechat_id)->hasManyWechatusers()->where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field,'wechat_id'=>$wechat_id])->links();
		}
		else
		{
			$list=Wechat::find($wechat_id)->hasManyWechatusers()->paginate($this->pagesize);
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
    
}
