<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :信件管理
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\Letter;
use DB;
use Cache;
use URL;

class LetterController extends PublicController
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
		$website['cursitename']=trans('admin.website_navigation_ten');
		$website['apiurl_list']=URL::action('Admin\LetterController@api_list');
		$website['apiurl_one_action']=URL::action('Admin\OneactionapiController@api_one_action');
		$website['apiurl_delete']=URL::action('Admin\DeleteapiController@api_delete');
		$website['link_add']=URL::action('Admin\LetterController@add');
		$website['way']='title';
		$wayoption[]=array('text'=>trans('admin.website_letter_item_title'),'value'=>'title');
		$website['wayoption']=json_encode($wayoption);
        
		return view('admin/letter/index')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加
	*******************************************/
	public function add()
	{
		$website=$this->website;
		$website['modelname']=getCurrentControllerName();
		$website['cursitename']=trans('admin.website_navigation_ten');
		$website['apiurl_add']=URL::action('Admin\LetterController@api_add');
		$website['id']=0;

		return view('admin/letter/add')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表接口
	*******************************************/
	public function api_list(Request $request)  
	{
		$search_field=$request->get('way')?$request->get('way'):'title';
		$keyword=$request->get('keyword');
		if($keyword)
		{
			$list=Letter::where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=Letter::paginate($this->pagesize);
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

}
