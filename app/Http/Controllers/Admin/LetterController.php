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
	****Title :收件箱
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.define_model_letter_received');
		$website['way']='title';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_title'),'value'=>'title');
		$website['wayoption']=json_encode($wayoption);
        
		return view('admin/letter/index')->with('website',$website);
	}

	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :发件箱
	*******************************************/
	public function send()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.define_model_letter_send');
		$website['way']='title';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_title'),'value'=>'title');
		$website['wayoption']=json_encode($wayoption);

		return view('admin/letter/index')->with('website',$website);
	}

	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :星标记
	*******************************************/
	public function star()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.define_model_letter_star');
		$website['way']='title';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_title'),'value'=>'title');
		$website['wayoption']=json_encode($wayoption);

		return view('admin/letter/index')->with('website',$website);
	}

	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :垃圾箱
	*******************************************/
	public function trash()  
	{
		$website=$this->website;
		$website['cursitename']=trans('admin.define_model_letter_trash');
		$website['way']='title';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_title'),'value'=>'title');
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
		$website['cursitename']=trans('admin.website_navigation_letter');
		$website['id']=0;

		return view('admin/letter/add')->with('website',$website);
	}
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表接口
	*******************************************/
	public function api_list(Request $request)  
	{
		$actionname=$request->get('actionname')?$request->get('actionname'):'index';
		switch($actionname)
		{
			case 'index':
							$condiiton['email_to']=$this->user['email'];
							$condiiton['istrash_to']=0;	
							$condiiton['isdel_to']=0;	
							$search_field=$request->get('way')?$request->get('way'):'title';
							$keyword=$request->get('keyword');
							if($keyword)
							{
								$list=Letter::where($condiiton)->where($search_field, 'like', '%'.$keyword.'%')->orderBy('updated_at','desc')->paginate($this->pagesize);
								//分页传参数
								$list->appends(['keyword' => $keyword,'way' =>$search_field,'actionname'=>$actionname])->links();
							}
							else
							{
								$list=Letter::where($condiiton)->orderBy('updated_at','desc')->paginate($this->pagesize);
								$list->appends(['actionname'=>$actionname])->links();
							}
			break;
			case 'send':
							$condiiton['email_from']=$this->user['email'];
							$condiiton['istrash_from']=0;	
							$condiiton['isdel_from']=0;	
							$search_field=$request->get('way')?$request->get('way'):'title';
							$keyword=$request->get('keyword');
							if($keyword)
							{
								$list=Letter::where($condiiton)->where($search_field, 'like', '%'.$keyword.'%')->orderBy('updated_at','desc')->paginate($this->pagesize);
								//分页传参数
								$list->appends(['keyword' => $keyword,'way' =>$search_field,'actionname'=>$actionname])->links();
							}
							else
							{
								$list=Letter::where($condiiton)->orderBy('updated_at','desc')->paginate($this->pagesize);
								$list->appends(['actionname'=>$actionname])->links();
							}
			break;
			case 'star':
							$condiiton_from['email_from']=$this->user['email'];
							$condiiton_from['isstar_from']=1;
							$condiiton_from['istrash_from']=0;	
							$condiiton_from['isdel_from']=0;

							$condiiton_to['email_to']=$this->user['email'];
							$condiiton_to['isstar_to']=1;
							$condiiton_to['istrash_to']=0;	
							$condiiton_to['isdel_to']=0;	
							$search_field=$request->get('way')?$request->get('way'):'title';
							$keyword=$request->get('keyword');
							if($keyword)
							{
								$list=Letter::orwhere($condiiton_to)->orwhere($condiiton_from)->where($search_field, 'like', '%'.$keyword.'%')->orderBy('updated_at','desc')->paginate($this->pagesize);
								//分页传参数
								$list->appends(['keyword' => $keyword,'way' =>$search_field,'actionname'=>$actionname])->links();
							}
							else
							{
								$list=Letter::orwhere($condiiton_to)->orwhere($condiiton_from)->orderBy('updated_at','desc')->paginate($this->pagesize);
								$list->appends(['actionname'=>$actionname])->links();
							}
			break;
			case 'trash':
							$condiiton_from['email_from']=$this->user['email'];
							$condiiton_from['istrash_from']=1;	
							$condiiton_from['isdel_from']=0;

							$condiiton_to['email_to']=$this->user['email'];
							$condiiton_to['istrash_to']=1;	
							$condiiton_to['isdel_to']=0;	
							$search_field=$request->get('way')?$request->get('way'):'title';
							$keyword=$request->get('keyword');
							if($keyword)
							{
								$list=Letter::orwhere($condiiton_to)->orwhere($condiiton_from)->where($search_field, 'like', '%'.$keyword.'%')->orderBy('updated_at','desc')->paginate($this->pagesize);
								//分页传参数
								$list->appends(['keyword' => $keyword,'way' =>$search_field,'actionname'=>$actionname])->links();
							}
							else
							{
								$list=Letter::orwhere($condiiton_to)->orwhere($condiiton_from)->orderBy('updated_at','desc')->paginate($this->pagesize);
								$list->appends(['actionname'=>$actionname])->links();
							}
			break;
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

		$params = new Letter;
		$params->title 		= $request->get('title');
        $params->content	= $request->get('content');
		$params->syseditor	= $request->get('syseditor');
        $params->email_to	= $request->get('email');
		$params->email_from	= $this->user['email'];

		if ($params->save()) 
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_send_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']=route('get.admin.letter.send');
			$msg_array['resource']='';
		} 
		else 
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_send_failure');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
		}	

        return response()->json($msg_array);

	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :统计接口
	*******************************************/
	public function api_count(Request $request)  
	{
		$email=$request->get('email')?$request->get('email'):$this->user['email'];
		if($email)
		{
			//index
			$condition_index['email_to']=$email;
			$condition_index['istrash_to']=0;
			$condition_index['isdel_to']=0;
			$count['count_index']=DB::table('letters')->where($condition_index)->count();

			//send
			$condition_send['email_from']=$email;
			$condition_send['istrash_from']=0;
			$condition_send['isdel_from']=0;
			$count['count_send']=DB::table('letters')->where($condition_send)->count();

			//star
			$condition_star_to['email_to']=$email;
			$condition_star_to['isstar_to']=1;
			$condition_star_to['istrash_to']=0;
			$condition_star_to['isdel_to']=0;
			$condition_star_from['email_from']=$email;
			$condition_star_from['isstar_from']=1;
			$condition_star_from['istrash_from']=0;
			$condition_star_from['isdel_from']=0;
			$count['count_star']=DB::table('letters')->orwhere($condition_star_to)->orwhere($condition_star_from)->count();

			//trash
			$condition_trash_to['email_to']=$email;
			$condition_trash_to['istrash_to']=1;
			$condition_trash_to['isdel_to']=0;
			$condition_trash_from['email_from']=$email;
			$condition_trash_from['istrash_from']=1;
			$condition_trash_from['isdel_from']=0;
			$count['count_trash']=DB::table('letters')->orwhere($condition_trash_to)->orwhere($condition_trash_from)->count();	
		}
		
		if($count)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_get_success');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=$count;
		}
		else
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_get_empty');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']="";
		}
        return response()->json($msg_array);
	}

}
