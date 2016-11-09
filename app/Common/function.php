<?php
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
 * 方法名：判断IE浏览器
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function is_ie()
{
	if(strpos($_SERVER["HTTP_USER_AGENT"],'MSIE'))
	{
		return 1;
	}
	else
	{
		return 0;
	}
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

/*******************************************
移动：134、135、136、137、138、139、150、151、152、157、158、159、182、183、184、187、188、178(4G)、147(上网卡)；
联通：130、131、132、155、156、185、186、176(4G)、145(上网卡)；
电信：133、153、180、181、189 、177(4G)；
卫星通信：1349
虚拟运营商：170
*验证手机号码有效性
*/
function isMobile($mobile) 
{
    if (!is_numeric($mobile)) 
    {
        return false;
    }
    return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
}

/***********************************
 * 方法名：日志记录
 * 作者： Tommy（rubbish.boy@163.com）
 + type 1 => 登录日志
 ***********************************/ 
function in_log($data)
{

    $log = new App\Http\Model\Log;
    $log->type = $data['type'];
    $log->user_id = $data['user_id'];
    $log->name = $data['name'];
    $log->info = $data['info'];
    $log->ip = $data['ip'];
    $log->save();
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
    $action = \Route::current()->getActionName();  
    list($class, $method) = explode('@', $action);  
    return ['controller' => $class, 'method' => $method];  
} 

?>
