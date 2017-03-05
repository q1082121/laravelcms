<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :会员积分
*******************************************/
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Score;
use DB;
use URL;

class ScoreController extends PublicController
{
    //
    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表
	*******************************************/
	public function index()  
	{
		$website=$this->website;
		$website['cursitename']=trans('user.user_navigation_score');
		$website['title']=$website['cursitename'];
		$website['way']='info';
		$wayoption[]=array('text'=>trans('admin.fieldname_item_info'),'value'=>'info');
		$website['wayoption']=json_encode($wayoption);

		return view('user/score/index')->with('website',$website);
	}

    /******************************************
	****AuThor:rubbish.boy@163.com
	****Title :列表接口
	*******************************************/
	public function api_list(Request $request)  
	{
		$search_field=$request->get('way')?$request->get('way'):'title';
		$condition['user_id']=$this->user['id'];
		$keyword=$request->get('keyword');
		if($keyword)
		{
			$list=Score::where($condition)->where($search_field, 'like', '%'.$keyword.'%')->orderBy('updated_at','desc')->paginate($this->pagesize);
			//分页传参数
			$list->appends(['keyword' => $keyword,'way' =>$search_field])->links();
		}
		else
		{
			$list=Score::where($condition)->orderBy('updated_at','desc')->paginate($this->pagesize);
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
	****Title :获取每天是否签到
	*******************************************/
	public function api_is_check_in(Request $request)
	{
		$user_id=$this->user['id'];
		$condition['type']=1;
		$condition['user_id']=$user_id;
		$startTime = date('Y-m-d'.' 00:00:00',time());
    	$endTime   = date('Y-m-d'.' 23:59:59',time());
		$is_get_today_check_in=object_array(DB::table('scores')->where($condition)->whereBetween('created_at', [$startTime, $endTime])->count());
		if($is_get_today_check_in==1)
		{
			$msg_array['status']='1';
			$msg_array['info']=trans('admin.message_check_in_exit');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=1;
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_check_in_not');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
			$msg_array['resource']=0;
		}
		
        return response()->json($msg_array);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :签到
	*******************************************/
	public function api_check_in(Request $request)  
	{
		$user_id=$this->user['id'];
		$condition['type']=1;
		$condition['user_id']=$user_id;
		$startTime = date('Y-m-d'.' 00:00:00',time());
    	$endTime   = date('Y-m-d'.' 23:59:59',time());
		$is_get_today_check_in=object_array(DB::table('scores')->where($condition)->whereBetween('created_at', [$startTime, $endTime])->count());
		if($is_get_today_check_in==0)
		{
			$score=$this->roleinfo['check_in_score']?$this->roleinfo['check_in_score']:1;
			$scoretpl = trans('user.score_action_info');
			// 带有替换信息的上下文数组，键名为占位符名称，键值为替换值。
			$score_context = interpolate($scoretpl, array('username' => $this->user['username'],'score'=>$score));

			$params_score['type']=1;
			$params_score['val']=$score;
			$params_score['info']=$score_context;
			$params_score['user_id']=$user_id;
			$params_score['tablename']="";
			$params_score['keyid']=0;

			$result_score=action_score_check_in($params_score);

			if($result_score==1)
			{
				$msg_array['status']='1';
				$msg_array['info']=trans('admin.message_check_in_success');
				$msg_array['is_reload']=1;
				$msg_array['curl']='';
				
			}
			else
			{
				$msg_array['status']='0';
				$msg_array['info']=trans('admin.message_check_in_failure');
				$msg_array['is_reload']=0;
				$msg_array['curl']='';
			}
			
		}
		else
		{
			$msg_array['status']='0';
			$msg_array['info']=trans('admin.message_check_in_exit');
			$msg_array['is_reload']=0;
			$msg_array['curl']='';
		}
		
        return response()->json($msg_array);
	}


}
