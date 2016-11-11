<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :题目题库
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Model\Question;
use DB;
use URL;
use Cache;
use App\Common\lib\Cates; 
class QuestionController extends PublicController
{
    //
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index($type)  
	{
		$website=$this->website;
        $website['modelname']=getCurrentControllerName();
		switch($type)
		{
			case 1:
					$website['cursitename']=trans('admin.website_navigation_question_radio');
			break;
			case 2:
					$website['cursitename']=trans('admin.website_navigation_question_multiple_choice');
			break;
			case 3:
					$website['cursitename']=trans('admin.website_navigation_question_judgment');
			break;
		}
		$website['type']=$type;
		$website['apiurl_list']=URL::action('Admin\QuestionController@api_list');
		$website['apiurl_one_action']=URL::action('Admin\OneactionapiController@api_one_action');
		$website['apiurl_delete']=URL::action('Admin\DeleteapiController@api_delete');
		$website['apiurl_cache']=URL::action('Admin\CacheapiController@api_cache');
		$website['link_add']=URL::action('Admin\QuestionController@add').'/'.$type;
		$website['link_edit']=route('get.admin.question.edit').'/';
		$website['link_option']=route('get.admin.questionoption').'/';
		$website['way']='title';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_title'),'value'=>'title');
		$website['wayoption']=json_encode($wayoption);
		

		return view('admin/question/index')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :添加
	*******************************************/
	public function add($type)
	{
		$website=$this->website;
        $website['modelname']=getCurrentControllerName();
		switch($type)
		{
			case 1:
					$website['cursitename']=trans('admin.website_navigation_question_radio');
			break;
			case 2:
					$website['cursitename']=trans('admin.website_navigation_question_multiple_choice');
			break;
			case 3:
					$website['cursitename']=trans('admin.website_navigation_question_judgment');
			break;
		}
		$website['type']=$type;
		$website['apiurl_add']=URL::action('Admin\QuestionController@api_add');
		$website['apiurl_info']=URL::action('Admin\QuestionController@api_info');
		$website['apiurl_edit']=URL::action('Admin\QuestionController@api_edit');
		$website['apiurl_del_image']=URL::action('Admin\DeleteapiController@api_del_image');
		$website['id']=0;
		
		
		$condition_class['status']=1;
        $list=object_array(DB::table('classifyquestions')->where($condition_class)->orderBy('id', 'desc')->get());
		if($list)
		{
			$cates=new Cates();
            $cates->type=2;
			$cates->opt($list);
			$classopts = $cates->opt;
			$classoptsdata = $cates->optdata;
			$website['classlist']=json_encode($classoptsdata);
		}
		else
		{
			$classlist[]=array('text'=>trans('admin.website_question_select'),'value'=>'0');
			$website['classlist']=json_encode($classlist);
		}

		return view('admin/question/add')->with('website',$website);
	}
    /******************************************
	****AuThor : rubbish.boy@163.com
	****Title  : 编辑信息
	*******************************************/
	public function edit($id)  
	{
		$website=$this->website;
        $website['modelname']=getCurrentControllerName();
		$website['apiurl_add']=URL::action('Admin\QuestionController@api_add');
		$website['apiurl_info']=URL::action('Admin\QuestionController@api_info');
		$website['apiurl_edit']=URL::action('Admin\QuestionController@api_edit');
		$website['apiurl_del_image']=URL::action('Admin\DeleteapiController@api_del_image');
		$website['id']=$id;
		$info = object_array(DB::table('questions')->whereId($id)->first());
		switch($info['type'])
		{
			case 1:
					$website['cursitename']=trans('admin.website_navigation_question_radio');
			break;
			case 2:
					$website['cursitename']=trans('admin.website_navigation_question_multiple_choice');
			break;
			case 3:
					$website['cursitename']=trans('admin.website_navigation_question_judgment');
			break;
		}
		$website['type']=$info['type'];
		$condition_class['status']=1;
        $list=object_array(DB::table('classifyquestions')->where($condition_class)->orderBy('id', 'desc')->get());
		if($list)
		{
			$cates=new Cates();
            $cates->type=2;
			$cates->opt($list);
			$classopts = $cates->opt;
			$classoptsdata = $cates->optdata;
			$website['classlist']=json_encode($classoptsdata);
		}
		else
		{
			$classlist[]=array('text'=>trans('admin.website_question_select'),'value'=>'0');
			$website['classlist']=json_encode($classlist);
		}

		return view('admin/question/add')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表接口
	*******************************************/
	public function api_list(Request $request)  
	{
		$type=$request->get('type')?$request->get('type'):1;
		$condiiton['type']=$type;
		$search_field=$request->get('way')?$request->get('way'):'name';
		$keyword=$request->get('keyword');
		if($keyword)
		{
			$list=Question::where($condiiton)->where($search_field, 'like', '%'.$keyword.'%')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field,'type'=>$type])->links();
		}
		else
		{
			$list=Question::where($condiiton)->paginate($this->pagesize);
			$list->appends(['type'=>$type])->links();
		}

		if($list)
		{
			$classlist=Cache::store('file')->get('classquestion');
			foreach($list as $key=>$val)
			{
				$list[$key]['classname']=$classlist[$val['classid']]['name'];
			}

			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_get_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$list;
			$msg_array['param_way']=$search_field;
			$msg_array['param_keyword']=$keyword;
		}
		else
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_get_empty');
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

		$params = new Question;
		$params->type 		= $request->get('type');
		$params->classid 	= $request->get('classid');
		$params->title 		= $request->get('title');
		$params->score 		= $request->get('score');
		$params->is_answer 	= $request->get('is_answer');
		$params->status		= $request->get('status');
		$params->user_id	= $this->user['id'];

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
			$msg_array['info']=trans('admin.message_add_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=URL::action('Admin\QuestionController@index').'/'.$params->type;
			$msg_array['resource']='';
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		} 
		else 
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_add_failure');
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
		$info=DB::table('questions')->where($condition)->first();
		if($info)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_get_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$info;
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_get_empty');
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

		$params = Question::find($request->get('id'));
		$params->classid 	= $request->get('classid');
		$params->title 		= $request->get('title');
		$params->score 		= $request->get('score');
		$params->is_answer	= $request->get('is_answer');
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
			$msg_array['info']=trans('admin.message_save_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=URL::action('Admin\QuestionController@index').'/'.$params->type;
			$msg_array['resource']='';
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';
		} 
		else 
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_save_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
			$msg_array['param_way']='';
			$msg_array['param_keyword']='';	
		}
		return response()->json($msg_array);
	}
}
