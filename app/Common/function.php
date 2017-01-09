<?php
/****************************************************************************************************
****AuThor:rubbish.boy@163.com
****Title :功能类型
*****************************************************************************************************/
/***********************************
 * 方法名：获取站内信息相关函数
 * 作者： Tommy（rubbish.boy@163.com）
 */
function getcon($varName)
{
	switch($res = get_cfg_var($varName))
	{
		case 0:
			return 'NO';
			break;
		case 1:
			return 'YES';
			break;
		default:
			return $res;
			break;
	}
}
/***********************************
 * 方法名： 判断是否存在该自定义函数
 * 作者： Tommy（rubbish.boy@163.com）
 */
function isfun($funName)
{
	return (false !== function_exists($funName))?'YES':'NO';
}
/***********************************
 * 方法名：查找字符串中是否存在某字符
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月11日
 ***********************************/
function check_string_sub($string,$sub,$type=1)
{
	$rule=0;
	$returntext="";
	if(!empty($sub))
	{
		$strarray=explode(',',$string);
		if(is_array($strarray))
		{
			foreach($strarray as $key=>$val)
			{
				if($val==$sub)
				{
					$rule=1;
				}
			}
		} 
		if($rule==1)
		{
			switch($type)
			{
				case 1:
						$returntext="checked";
						break;	
				case 2:
						$returntext=true;
						break;			
			}
		}
	}	
	return $returntext;
}
/***********************************
 * 方法名：layer 封装提示跳转
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function alert($url,$info)
{
	echo  '<script language="javascript" type="text/javascript"> alert("'.$info.'");window.location.href="'.$url.'";</script>';
}
/***********************************
 * 方法名：Curl 请求
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function http_curl_request($url,$data=null,$isjson=0)
{
	   $curl = curl_init(); // 启动一个CURL会话
	   curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
	   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
	   curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
	   curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
	   if($data != null){
		   if($isjson==0)
		   {
			   $data=http_build_query($data);
		   }
		   curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
		   curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
	   }
	   curl_setopt($curl, CURLOPT_TIMEOUT, 300); // 设置超时限制防止死循环
	   curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
	   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
	   $info = curl_exec($curl); // 执行操作
	   if (curl_errno($curl)) {
		   echo 'Errno:'.curl_getinfo($curl);//捕抓异常
		   var_dump(curl_getinfo($curl));
	   }
	   return $info;
}
/***********************************
 * 方法名：判断访问终端是否手机
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/ 
function is_mobile_request()
{    
	$_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
	$mobile_browser = '0';
	if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))     $mobile_browser++;
		if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))     $mobile_browser++;
	    	if(isset($_SERVER['HTTP_X_WAP_PROFILE']))     $mobile_browser++;    if(isset($_SERVER['HTTP_PROFILE']))     $mobile_browser++;    
	    		$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
	    		    $mobile_agents = array('w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac', 'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno', 'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-', 'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-','newt','noki','oper','palm','pana','pant','phil','play','port','prox','qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar', 'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-','tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp','wapr','webc','winw','winw','xda','xda-');
	    		        if(in_array($mobile_ua, $mobile_agents))     $mobile_browser++;
	    		            if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)     $mobile_browser++;   // Pre-final check to reset everything if the user is on Windows
	    		                if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)     $mobile_browser=0;    // But WP7 is also Windows, with a slightly different characteristic
	    		                    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)     $mobile_browser++;
	    		                        if($mobile_browser>0)     return true;
	    		                            else   return false;
}
/***********************************
 * 方法名：PHP stdClass Object转array
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/ 
function object_array($array)
{
   if(is_object($array))
   {
    $array = (array)$array;
   }
   if(is_array($array))
   {
    foreach($array as $key=>$value)
    {
     $array[$key] = object_array($value);
    }
   }
   return $array;
}
/***********************************
 * 方法名：PHP stdClass array转Object
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function arrayToObject($arr){
    if(is_array($arr)){
        return (object) array_map(__FUNCTION__, $arr);
    }else{
        return $arr;
    }
}
/***********************************
 * 方法名： 获取当前控制器名  
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/ 
function getCurrentControllerName($group='Admin')  
{  
	$fullname=getCurrentAction()['controller'];
	switch ($group) 
	{
		case 'Admin':
			$string = substr($fullname, 27);
			$string = str_replace("Controller", "", $string);
			break;
		case 'User':
			$string = substr($fullname, 26);
			$string = str_replace("Controller", "", $string);
			break;	
		case 'Home':
			$string = substr($fullname, 21);
			$string = str_replace("Controller", "", $string);
			break;
	}
    return $string;  
}  
/***********************************
 * 方法名： 获取当前方法名   
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/  
function getCurrentMethodName()  
{  
	$fullname=getCurrentAction()['method'];
	return $fullname;
}  
/***********************************
 * 方法名： 获取当前控制器与方法 
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/ 
function getCurrentAction()  
{  
	if(\Route::getCurrentRoute())
	{
		$action = \Route::getCurrentRoute()->getActionName();
	}
	else
	{
		$data=\Request::route()->getAction();
		$action = $data['controller'];
	}
      
    list($class, $method) = explode('@', $action);  
    return ['controller' => $class, 'method' => $method];  
} 
/***********************************
 * 方法名： 获取客户端IP
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/ 
function get_client_ip()
{
	$ip=$_SERVER['REMOTE_ADDR'];
	return $ip;
}
/***********************************
 * 方法名： 用上下文信息替换记录信息中的占位符
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/ 
function interpolate($message, array $context = array()){
    // 构建一个花括号包含的键名的替换数组
    $replace = array();
    foreach ($context as $key => $val) {
        $replace['{' . $key . '}'] = $val;
    }
    // 替换记录信息中的占位符，最后返回修改后的记录信息。
    return strtr($message, $replace);
} 
/***********************************
 * 方法名： 获取中文字符串首字母
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/ 
function chineseFirst($str)
{
    //判断字符串是否全都是中文
    if (preg_match("/^[\x7f-\xff]/", $str))
    {
        $fchar=ord($str{0});   
        if($fchar>=ord("A") and $fchar<=ord("z") )return strtoupper($str{0});
        $a = $str; 
        $val=ord($a{0})*256+ord($a{1})-65536;
        if($val>=-20319 and $val<=-20284)return "A";   
        if($val>=-20283 and $val<=-19776)return "B";   
        if($val>=-19775 and $val<=-19219)return "C";   
        if($val>=-19218 and $val<=-18711)return "D";   
        if($val>=-18710 and $val<=-18527)return "E";   
        if($val>=-18526 and $val<=-18240)return "F";   
        if($val>=-18239 and $val<=-17923)return "G";   
        if($val>=-17922 and $val<=-17418)return "H";
        if($val>=-17417 and $val<=-16475)return "J";                 
        if($val>=-16474 and $val<=-16213)return "K";                 
        if($val>=-16212 and $val<=-15641)return "L";                 
        if($val>=-15640 and $val<=-15166)return "M";                 
        if($val>=-15165 and $val<=-14923)return "N";                 
        if($val>=-14922 and $val<=-14915)return "O";                 
        if($val>=-14914 and $val<=-14631)return "P";                 
        if($val>=-14630 and $val<=-14150)return "Q";                 
        if($val>=-14149 and $val<=-14091)return "R";                 
        if($val>=-14090 and $val<=-13319)return "S";                 
        if($val>=-13318 and $val<=-12839)return "T";                 
        if($val>=-12838 and $val<=-12557)return "W";                 
        if($val>=-12556 and $val<=-11848)return "X";                 
        if($val>=-11847 and $val<=-11056)return "Y";                 
        if($val>=-11055 and $val<=-10247)return "Z";
    }
	else
    {
        return false;
    }

}
/***********************************
 * 方法名：
 * 作者： 解析html标签
 * 时间：2015年6月10日
 ***********************************/
function htmlcontent($content)
{
	$tmp_content=stripslashes(htmlspecialchars_decode(trim($content)));
	return $tmp_content;	
}
/****************************************************************************************************
****AuThor:rubbish.boy@163.com
****Title :业务逻辑
*****************************************************************************************************/
/***********************************
 * 方法名：Json消息返回封装函数
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function json_message($act=0,$data=null,$info=null)
{
	switch($act)
	{
		case 1:
				$message['data']=$data;
				$message['code']=666;
				$message['info']=$info!=null?$info:'操作成功';
				$message['success']=1;
				break;
		case 2:
				$message['data']=$data;
				$message['code']=110;
				$message['info']=$info!=null?$info:'无效的参数';
				$message['success']=0;
				break;
		default:
				$message['data']=$data;
				$message['code']=404;
				$message['info']=$info!=null?$info:'未接受到数据';
				$message['success']=0;
	}
	return json_encode($message);
}

/***********************************
 * 方法名：日志记录
 * 作者： Tommy（rubbish.boy@163.com）
 + type 1 => 登录
 ***********************************/ 
function in_log($data)
{

    $log = new App\Http\Model\Log;
    $log->type = $data['type'];
    $log->user_id = $data['user_id'];
    $log->name = $data['name'];
    $log->info = $data['info'];
    $log->ip = $data['ip'];
    return $log->save();
}
/***********************************
 * 方法名：微信关键词记录
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/ 
function in_wechat_keyword($data)
{

    $subparams = new App\Http\Model\Wechatkeyword;
    $subparams->type  				= $data['type'];
	$subparams->tablename			= $data['tablename'];
	$subparams->field_id			= $data['field_id'];
	$subparams->field_keyword 		= $data['field_keyword'];
	$subparams->wechat_id 			= $data['wechat_id'];
    return $subparams->save();
}
/***********************************
 * 方法名：操作缓存数据
 * 作者： Tommy（rubbish.boy@163.com）
 + way get => 获取
 + way update => 更新
 ***********************************/ 
function action_cache($user_id,$cache_prefix,$way="get")
{
	$minutes=14400;
	$cache_name=$cache_prefix.'_'.$user_id;
	$default_session_cache_type=env('SESSION_DRIVER', "file");
	switch($cache_prefix)
	{
		case 'userinfo':
							$modelname = new App\Http\Model\User;
							switch($default_session_cache_type)
							{
								case 'file':
											switch($way)
											{
												case 'get':
															//file 版缓存
															if (Illuminate\Support\Facades\Cache::store('file')->has($cache_name)) 
															{
																
															}
															else
															{
																$info= $modelname->find($user_id)->hasOneUserinfo->toArray();
																Illuminate\Support\Facades\Cache::store('file')->put($cache_name, $info, $minutes);
															}
												break;
												case 'update':
															$info= $modelname->find($user_id)->hasOneUserinfo->toArray();
															Illuminate\Support\Facades\Cache::store('file')->put($cache_name, $info, $minutes);
												break;
											}
											
											$cache_data= Illuminate\Support\Facades\Cache::store('file')->get($cache_name);
											break;
								case 'redis':
											switch($way)
											{
												case 'get':
															//Redis 版缓存
															if ( Illuminate\Support\Facades\Redis::get($cache_name)) 
															{

															}
															else
															{
																$info= $modelname->find($user_id)->hasOneUserinfo->toArray();
																Illuminate\Support\Facades\Redis::set($cache_name,json_encode($info));
															}
												break;
												case 'update':
															$info= $modelname->find($user_id)->hasOneUserinfo->toArray();
															Illuminate\Support\Facades\Redis::set($cache_name,json_encode($info));
												break;
											}
											$cache_data=json_decode(Illuminate\Support\Facades\Redis::get($cache_name),true);
											break;
							}	
		break;
		case 'userrole':
							
							switch($default_session_cache_type)
							{
								case 'file':
											switch($way)
											{
												case 'get':
															//file 版缓存
															if (Illuminate\Support\Facades\Cache::store('file')->has($cache_name)) 
															{
																
															}
															else
															{
																//获取用户组信息
																$roleids=object_array(Illuminate\Support\Facades\DB::table('role_user')->where('user_id',$user_id)->pluck('role_id'));
																if($roleids)
																{
																	$info=object_array(Illuminate\Support\Facades\DB::table('roles')->whereIn('id',$roleids)->orderBy('type', 'asc')->orderBy('level', 'desc')->first());
																}
																Illuminate\Support\Facades\Cache::store('file')->put($cache_name, @$info, $minutes);
															}
												break;
												case 'update':
															//获取用户组信息
															$roleids=object_array(Illuminate\Support\Facades\DB::table('role_user')->where('user_id',$user_id)->pluck('role_id'));
															if($roleids)
															{
																$info=object_array(Illuminate\Support\Facades\DB::table('roles')->whereIn('id',$roleids)->orderBy('type', 'asc')->orderBy('level', 'desc')->first());
															}

															Illuminate\Support\Facades\Cache::store('file')->put($cache_name, $info, $minutes);
												break;
											}
											
											$cache_data= Illuminate\Support\Facades\Cache::store('file')->get($cache_name);
											break;
								case 'redis':
											switch($way)
											{
												case 'get':
															//Redis 版缓存
															if ( Illuminate\Support\Facades\Redis::get($cache_name)) 
															{
															
															}
															else
															{
																//获取用户组信息
																$roleids=object_array(Illuminate\Support\Facades\DB::table('role_user')->where('user_id',$user_id)->pluck('role_id'));
																if($roleids)
																{
																	$info=object_array(Illuminate\Support\Facades\DB::table('roles')->whereIn('id',$roleids)->orderBy('type', 'asc')->orderBy('level', 'desc')->first());
																}
																Illuminate\Support\Facades\Redis::set($cache_name,json_encode($info));
															}
												break;
												case 'update':
															//获取用户组信息
															$roleids=object_array(Illuminate\Support\Facades\DB::table('role_user')->where('user_id',$user_id)->pluck('role_id'));
															if($roleids)
															{
																$info=object_array(Illuminate\Support\Facades\DB::table('roles')->whereIn('id',$roleids)->orderBy('type', 'asc')->orderBy('level', 'desc')->first());
															}
															Illuminate\Support\Facades\Redis::set($cache_name,json_encode($info));
												break;
											}
											$cache_data=json_decode(Illuminate\Support\Facades\Redis::get($cache_name),true);
											break;
							}	
		break;
	}
	return $cache_data;	
}
/***********************************
 * 方法名：经验值操作
 * 作者： Tommy（rubbish.boy@163.com）
  + type 1 => 登录
 ***********************************/ 
function action_experience($params_experience,$roleinfo)
{
	Illuminate\Support\Facades\DB::beginTransaction();
	try
	{ 		
		$experience = new App\Http\Model\Experience;
		$experience->type = $params_experience['type'];
		$experience->user_id = $params_experience['user_id'];
		$experience->val = $params_experience['val'];
		$experience->info = $params_experience['info'];
		$experience->tablename = $params_experience['tablename'];
		$experience->keyid = $params_experience['keyid'];
		$result_experience=$experience->save();
		if($result_experience)
		{
			//获得经验值   
			$userinfos_condition['user_id']=$params_experience['user_id'];
			Illuminate\Support\Facades\DB::table('userinfos')->where($userinfos_condition)->increment('experience', $experience->val);
			//判断经验值是否升级角色组
			$userinfos=object_array(Illuminate\Support\Facades\DB::table('userinfos')->where($userinfos_condition)->first());
			if($roleinfo['type']==4 && $userinfos['experience']>=$roleinfo['level_up_experience'])
			{
			$level_up=$roleinfo['level']+1;
			$level_up_info=object_array(Illuminate\Support\Facades\DB::table('roles')->where('level',$level_up)->orderBy('type', 'asc')->orderBy('level', 'desc')->first());
			if($level_up_info)
			{
				$level_up_params['user_id']=$params_experience['user_id'];
				$level_up_params['role_id']=$level_up_info['id'];
				$level_up_result=Illuminate\Support\Facades\DB::table('role_user')->insert($level_up_params);
				if($level_up_result)
				{
					action_cache($params_experience['user_id'],'userinfo','update');
					action_cache($params_experience['user_id'],'userrole','update');
					Illuminate\Support\Facades\DB::commit();
				}
				else
				{
					Illuminate\Support\Facades\DB::rollBack();
				}
			}
			else
			{
				Illuminate\Support\Facades\DB::commit();
			}
			}
			else
			{
				Illuminate\Support\Facades\DB::commit();
			}
		}
		else
		{
			Illuminate\Support\Facades\DB::rollBack();
		}
	}
	catch (\Exception $e) 
	{ 
		Illuminate\Support\Facades\DB::rollBack(); 
	}
}
/***********************************
 * 方法名：积分获取
 * 作者： Tommy（rubbish.boy@163.com）
  + type 1 => 每日签到
 ***********************************/ 
function action_score_check_in($params_score)
{
	$rule=0;
	Illuminate\Support\Facades\DB::beginTransaction();
	try
	{ 		
		$score = new App\Http\Model\Score;
		$score->type = $params_score['type'];
		$score->user_id = $params_score['user_id'];
		$score->val = $params_score['val'];
		$score->info = $params_score['info'];
		$score->tablename = $params_score['tablename'];
		$score->keyid = $params_score['keyid'];
		$result_score=$score->save();
		if($result_score)
		{
			$rule=1;
			//获得积分   
			$userinfos_condition['user_id']=$params_score['user_id'];
			Illuminate\Support\Facades\DB::table('userinfos')->where($userinfos_condition)->increment('score', $score->val);
			action_cache($params_score['user_id'],'userinfo','update');
			
			Illuminate\Support\Facades\DB::commit();
		}
		else
		{
			Illuminate\Support\Facades\DB::rollBack();
		}
	}
	catch (\Exception $e) 
	{ 
		Illuminate\Support\Facades\DB::rollBack(); 
	}
	return $rule;
}


/******************************************
****AuThor:rubbish.boy@163.com
****Title :图片上传
*******************************************/
function uploads_action($classname,$data_image,$thumb_width=200,$thumb_height=200,$is_thumb=1,$is_watermark=1,$root)
{
	// 引入 composer autoload
	$suffix='.png';
	require base_path('vendor').'/autoload.php';
	//上传文件夹路径
	$uploads_dir=public_path('uploads');
	//上传日期时间
	$datetime=date('YmdHis');
	//水印图片路径
	$watermark_dir=public_path('watermark').'/logo.png';
	$datetimename=$datetime.$suffix;
	//保存文件名
	$filename=$uploads_dir.'/'.$classname.'/'.$datetimename;
	$watermark_filename=$uploads_dir.'/'.$classname.'/watermark/'.$datetimename;
	$thumb_filename=$uploads_dir.'/'.$classname.'/thumb/'.$datetimename;

	switch($classname)
	{
		case "Navigation":

		break;
		case "Classify":

		break;
		case "Classifylink":

		break;
		case "Classifyproduct":

		break;
		case "Classifyquestion":

		break;
		case "Link":

		break;
		case "Question":

		break;
		case "Questionoption":

		break;
		case "User":

		break;
		case "Wechat":

		break;
		case "Wechatreplyimagetext":

		break;
		case "Productattribute":

		break;
		default:
				if($is_watermark==1)
				{	
					if(!is_dir($uploads_dir.'/'.$classname.'/watermark/')) 
					{
						mkdir($uploads_dir.'/'.$classname.'/watermark/', 0777, true);
					}
					// 合成水印
					$img = Intervention\Image\Facades\Image::make($data_image)->insert($watermark_dir, 'bottom-right', 15, 10)->save($watermark_filename);
				}
		break;
	}
	
	if($is_thumb==1)
	{
		switch($classname)
		{
			case 'Navigation':
							$thumb_width=@$root['navigation_thumb_width']?@$root['navigation_thumb_width']:$thumb_width;
							$thumb_height=@$root['navigation_thumb_height']?@$root['navigation_thumb_height']:$thumb_height;	
			break;
			case 'Classify':
							$thumb_width=@$root['classify_thumb_width']?@$root['classify_thumb_width']:$thumb_width;
							$thumb_height=@$root['classify_thumb_height']?@$root['classify_thumb_height']:$thumb_height;	
			break;
			case 'Classifylink':
							$thumb_width=@$root['classifylink_thumb_width']?@$root['classifylink_thumb_width']:$thumb_width;
							$thumb_height=@$root['classifylink_thumb_height']?@$root['classifylink_thumb_height']:$thumb_height;	
			break;
			case 'Classifyproduct':
							$thumb_width=@$root['classifyproduct_thumb_width']?@$root['classifyproduct_thumb_width']:$thumb_width;
							$thumb_height=@$root['classifyproduct_thumb_height']?@$root['classifyproduct_thumb_height']:$thumb_height;	
			break;
			case 'Classifyquestion':
							$thumb_width=@$root['classifyquestion_thumb_width']?@$root['classifyquestion_thumb_width']:$thumb_width;
							$thumb_height=@$root['classifyquestion_thumb_height']?@$root['classifyquestion_thumb_height']:$thumb_height;	
			break;
			case 'Article':
							$thumb_width=@$root['article_thumb_width']?@$root['article_thumb_width']:$thumb_width;
							$thumb_height=@$root['article_thumb_height']?@$root['article_thumb_height']:$thumb_height;	
			break;
			case 'Product':
							$thumb_width=@$root['product_thumb_width']?@$root['product_thumb_width']:$thumb_width;
							$thumb_height=@$root['product_thumb_height']?@$root['product_thumb_height']:$thumb_height;	
			break;
			case 'Picture':
							$thumb_width=@$root['picture_thumb_width']?@$root['picture_thumb_width']:$thumb_width;
							$thumb_height=@$root['picture_thumb_height']?@$root['picture_thumb_height']:$thumb_height;	
			break;
			case 'Link':
							$thumb_width=@$root['link_thumb_width']?@$root['link_thumb_width']:$thumb_width;
							$thumb_height=@$root['link_thumb_height']?@$root['link_thumb_height']:$thumb_height;	
			break;
			case 'Questionoption':
							$thumb_width=@$root['question_thumb_width']?@$root['question_thumb_width']:$thumb_width;
							$thumb_height=@$root['question_thumb_height']?@$root['question_thumb_height']:$thumb_height;	
			break;
			case 'Questionoption':
							$thumb_width=@$root['questionoption_thumb_width']?@$root['questionoption_thumb_width']:$thumb_width;
							$thumb_height=@$root['questionoption_thumb_height']?@$root['questionoption_thumb_height']:$thumb_height;	
			break;
			case 'User':
							$thumb_width=@$root['user_thumb_width']?@$root['user_thumb_width']:$thumb_width;
							$thumb_height=@$root['user_thumb_height']?@$root['user_thumb_height']:$thumb_height;	
			break;
			case 'Wechat':
							$thumb_width=@$root['wechat_thumb_width']?@$root['wechat_thumb_width']:$thumb_width;
							$thumb_height=@$root['wechat_thumb_height']?@$root['wechat_thumb_height']:$thumb_height;
			break;
			case 'Wechatreplyimagetext':
							$thumb_width=@$root['wechatreplyimagetext_thumb_width']?@$root['wechatreplyimagetext_thumb_width']:$thumb_width;
							$thumb_height=@$root['wechatreplyimagetext_thumb_height']?@$root['wechatreplyimagetext_thumb_height']:$thumb_height;
			break;
			case 'Productattribute':
							$thumb_width=@$root['productattribute_thumb_width']?@$root['productattribute_thumb_width']:$thumb_width;
							$thumb_height=@$root['productattribute_thumb_height']?@$root['productattribute_thumb_height']:$thumb_height;
			break;
			default:
							
			break;
		}
		if(!is_dir($uploads_dir.'/'.$classname.'/thumb/')) 
		{
			mkdir($uploads_dir.'/'.$classname.'/thumb/', 0777, true);
		}
		// 生成缩略图
		$img = Intervention\Image\Facades\Image::make($data_image)->resize($thumb_width,$thumb_height)->save($thumb_filename);
		
	}

	if(!is_dir($uploads_dir.'/'.$classname.'/')) 
	{
		mkdir($uploads_dir.'/'.$classname.'/', 0777, true);
	}

	// 将处理后的图片重新保存到其他路径
	Intervention\Image\Facades\Image::make($data_image)->save($filename);

	return $datetimename;

}
/******************************************
****@AuThor : rubbish.boy@163.com
****@Title  : 删除图片
****@return : Response
*******************************************/
function del_image_action($classname,$attachment)
{
	//上传文件夹路径
	$uploads_dir=public_path('uploads');
	//保存文件名
	$filename=$uploads_dir.'/'.$classname.'/'.$attachment;
	$watermark_filename=$uploads_dir.'/'.$classname.'/watermark/'.$attachment;
	$thumb_filename=$uploads_dir.'/'.$classname.'/thumb/'.$attachment;

	
	if (file_exists($watermark_filename)) 
	{
		unlink ($watermark_filename);
	}
	if (file_exists($thumb_filename)) 
	{
		unlink ($thumb_filename);
	}
	if (file_exists($filename)) 
	{
		$result=unlink ($filename);
	}
	else
	{
		$result=0;
	}

	return $result;
}
/***********************************
 * 方法名：过滤文件后缀
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/ 
function filter_suffixes($str)
{
	$str= str_replace(".html", "", $str);
	$str= str_replace(".htm", "", $str);
	$str= str_replace(".php", "", $str);
	$str= str_replace(".asp", "", $str);
	$str= str_replace(".aspx", "", $str);
	$str= str_replace(".js", "", $str);
	$str= str_replace(".css", "", $str);
	return $str;
}
/***********************************
 * 方法名：unicode转utf8
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月17日
 ***********************************/ 
function unicode2utf8_2($str) {
		$str=strtolower($str);
		$str = "\u".$str;
        $str = '{"result_str":"' . $str . '"}'; 
        $strarray = json_decode ( $str, true ); 
		$returnstr=$strarray['result_str'];
        return $returnstr;
}
/***********************************
 * 方法名：微信关键词检索
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/ 
function search_keyword($keyword,$mp,$limit=9)
{
	$result['type']="text";
	$result['data']="";
	switch($keyword)
	{
		case "优惠券":
		break;

		default:
				//检索图文类型
				$condition['type']="imagetext";
				$condition['wechat_id']=$mp['id'];
				$datas=object_array(DB::table('wechatkeywords')->where($condition)->where("field_keyword", 'like', '%'.$keyword.'%')->take($limit)->get());
				if($datas)
				{
					$result['type']="imagetext";
					$result['data']=$datas;
				}
				else
				{
					//检索文本类型
					$condition_text['type']="text";
					$condition_text['wechat_id']=$mp['id'];
					$condition_text['field_keyword']=$keyword;
					$datas=object_array(DB::table('wechatkeywords')->where($condition_text)->first());
					if($datas)
					{
						switch($datas['tablename'])
						{
							case "wechatreplytexts":
													$textinfo=object_array(DB::table('wechatreplytexts')->whereId($datas['field_id'])->first());
													$content=$textinfo['content'];
							break;
						}
						
						
						$result['type']="text";
						$result['data']=$content;
					}
					else
					{
						//获取默认回复
						if($mp['default_text'])
						{
							$result['type']="text";
							$result['data']=$mp['default_text'];
						}
						elseif($mp['default_keyword'] && $mp['default_keyword']!=$keyword)
						{
							return search_keyword($mp['default_keyword'],$mp);
						}
						else
						{
							$result['type']="text";
							$result['data']="暂无内容,敬请期待！";
						}
					}
				}
		break;
	}
	
	return $result;
}
/***********************************
 * 方法名：小程序获取用户信息
 * 作者： Tommy（rubbish.boy@163.com）
  + type 1 => 每日签到
 ***********************************/ 
function action_xcxuser_info($xcxuser)
{
	$xcxuser_array['nickName']=$xcxuser['nickname'];
	$xcxuser_array['nickname_encode']=$xcxuser['nickname_encode'];
	$xcxuser_array['gender']=$xcxuser['gender'];
	$xcxuser_array['city']=$xcxuser['city'];
	$xcxuser_array['province']=$xcxuser['province'];
	$xcxuser_array['country']=$xcxuser['country'];
	$xcxuser_array['avatarUrl']=$xcxuser['avatarurl'];
	$xcxuser_array['score']=$xcxuser['score'];
	$xcxuser_array['money']=$xcxuser['money'];
	return $xcxuser_array;
}
/***********************************
 * 方法名：小程序积分获取
 * 作者： Tommy（rubbish.boy@163.com）
  + type 1 => 每日签到
 ***********************************/ 
function action_xcxscore_check_in($params_score)
{
	$rule=0;
	Illuminate\Support\Facades\DB::beginTransaction();
	try
	{ 		
		$score = new App\Http\Model\Xcxscore;
		$score->type = $params_score['type'];
		$score->xcxuser_id = $params_score['xcxuser_id'];
		$score->val = $params_score['val'];
		$score->info = $params_score['info'];
		$score->tablename = $params_score['tablename'];
		$score->keyid = $params_score['keyid'];
		$result_score=$score->save();
		if($result_score)
		{
			
			//获得积分   
			$userinfos_condition['id']=$params_score['xcxuser_id'];
			Illuminate\Support\Facades\DB::table('xcxusers')->where($userinfos_condition)->increment('score', $score->val);
			$rule=1;
			Illuminate\Support\Facades\DB::commit();
		}
		else
		{
			Illuminate\Support\Facades\DB::rollBack();
		}
	}
	catch (\Exception $e) 
	{ 
		Illuminate\Support\Facades\DB::rollBack(); 
	}
	return $rule;
}
?>
