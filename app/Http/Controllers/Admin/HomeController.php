<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :后台信息
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Cache;

class HomeController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :后台首页
	*******************************************/
	public function index()  
	{
		//dump($this->website);
		$website=$this->website;
		$website['cursitename']=trans('admin.website_navigation_one');
		
		//Log
		$website['count_log']=$count_article=DB::table('logs')->count();
		//User
		$website['count_user']=$count_user=DB::table('users')->count();
		//Permissions
		$website['count_permission']=$count_permission=DB::table('permissions')->count();
		//Role
		$website['count_role']=$count_role=DB::table('roles')->count();
		//Navigation
		$website['count_navigation']=$count_navigation=DB::table('navigations')->count();
		//Classify
		$website['count_classify']=$count_classify=DB::table('classifies')->count();
		//Article
		$website['count_article']=$count_article=DB::table('articles')->count();
		//Classifyproduct
		$website['count_classifyproduct']=$count_classifyproduct=DB::table('classifyproducts')->count();
		//Product
		$website['count_product']=$count_product=DB::table('products')->count();
		//Picture
		$website['count_picture']=$count_picture=DB::table('pictures')->count();
		//Link
		$website['count_link']=$count_link=DB::table('links')->count();
		//Question
		$website['count_question']=$count_question=DB::table('questions')->count();
		//Questionoption
		$website['count_questionoption']=$count_questionoption=DB::table('questionoptions')->count();
		//Classifylink
		$website['count_classifylink']=$count_classifylink=DB::table('classifylinks')->count();
		//Wechat
		$website['count_wechat']=$count_wechat=DB::table('wechats')->count();
		//Letter_from
		$condiiton_from['email_from']=$this->user['email'];
		$condiiton_from['istrash_from']=0;	
		$condiiton_from['isdel_from']=0;	
		$website['count_letter_from']=$count_letter_from=DB::table('letters')->where($condiiton_from)->count();
		//Letter_to
		$condiiton_to['email_to']=$this->user['email'];
		$condiiton_to['istrash_to']=0;	
		$condiiton_to['isdel_to']=0;	
		$website['count_letter_to']=$count_letter_to=DB::table('letters')->where($condiiton_to)->count();
		

		/*------------------------------------------
		 -服务器信息
		 -------------------------------------------
		 */
		$serverinfo['phpver']				=PHP_VERSION;
		$serverinfo['phpos']				=PHP_OS;
		$serverinfo['server_soft'] 			=$_SERVER['SERVER_SOFTWARE'];
		$serverinfo['server_host'] 			=$_SERVER['SERVER_NAME'];
		$serverinfo['server_port'] 			=$_SERVER['SERVER_PORT'];
		$serverinfo['serverapi']			=strtoupper(php_sapi_name());
		$serverinfo['phpdir']				=DEFAULT_INCLUDE_PATH;
		$serverinfo['xcachesp']				=@extension_loaded('XCache')?'YES':'NO';
		$serverinfo['cookiesp']				=isset($_COOKIE)?'YES':'NO';
		$serverinfo['phpsafe']				=getcon("safe_mode");
		$serverinfo['dispalyerror']			=getcon("display_errors");
		$serverinfo['allowurlopen']			=getcon("allow_url_fopen");
		$serverinfo['registerglobal']		=getcon("register_globals");
		$serverinfo['maxpostsize']			=getcon("post_max_size");
		$serverinfo['maxupsize']			=getcon("upload_max_filesize");
		$serverinfo['maxexectime']			=getcon("max_execution_time").'s';
		$serverinfo['mqqsp']				=get_magic_quotes_gpc()===1?'YES':'NO';
		$serverinfo['mprsp']				=get_magic_quotes_runtime()===1?'YES':'NO';
		$serverinfo['dbasp']				=extension_loaded('dba')?'YES':'NO';
		$serverinfo['zendoptsp']			=(get_cfg_var("zend_optimizer.optimization_level")||get_cfg_var("zend_extension_manager.optimizer_ts")||get_cfg_var("zend_extension_ts"))?'YES':'NO';
		$serverinfo['curlsp']				=isfun('curl_init');
		$serverinfo['gdsp']					=isfun('gd_info');
		$serverinfo['zlibsp']				=isfun('gzclose');
		$serverinfo['eaccsp']				=isfun('eaccelerator_info');
		$serverinfo['sessionsp']			=isfun("session_start");
		$serverinfo['serverip']				=@gethostbyname($_SERVER['SERVER_NAME']);
		$serverinfo['systime']				=gmdate("Y年n月j日 H:i:s",time()+8*3600); 
		$website['serverinfo']=$serverinfo;

		return view('admin/home')->with('website',$website);
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :缓存布局设置
	*******************************************/
	public function api_setting(Request $request)
	{
		$attributes = $request->get('layout_attributes');
		$getdata=$request->all();
		$prefix=strpos($attributes,"_");
		if($prefix==6)
		{
			$getdata[$attributes]=$getdata[$attributes]==1?0:1;
		}
		else
		{
			$getdata['skin_blue']=0;
			$getdata['skin_black']=0;
			$getdata['skin_purple']=0;
			$getdata['skin_green']=0;
			$getdata['skin_red']=0;
			$getdata['skin_yellow']=0;
			$getdata['skin_blue_light']=0;
			$getdata['skin_black_light']=0;
			$getdata['skin_purple_light']=0;
			$getdata['skin_green_light']=0;
			$getdata['skin_red_light']=0;
			$getdata['skin_yellow_light']=0;

			$getdata[$attributes]=1;
		}
		
		Cache::store('file')->forever('setting', $getdata);
		$msg_array['status']='1';
		$msg_array['info']=trans('admin.website_action_set_success');
		$msg_array['is_reload']=1;
		$msg_array['resource']=$getdata;
		
        return response()->json($msg_array);

	}

}
