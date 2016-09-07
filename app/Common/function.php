<?php
/***********************************
 * 方法名：判断IE浏览器
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月10日
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
 * 方法名：加密函数
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月10日
 ***********************************/
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) 
{
	$ckey_length = 4;
	$key = md5($key ? $key : $GLOBALS['authkey']);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}

}
/***********************************
 * 方法名：Json消息返回封装函数
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月10日
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
 * 时间：2015年6月10日
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
 * 方法名：获取24位长度的唯一编号
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月10日
 ***********************************/
function get_authid()
{
    //生成24位唯一订单号码，格式：YYYY-MMDD-HHII-SS-NNNN,NNNN-CC，其中：YYYY=年份，MM=月份，DD=日期，HH=24格式小时，II=分，SS=秒，NNNNNNNN=随机数，CC=检查码    
	@date_default_timezone_set("PRC"); 
	//当前日期     
	$order_date = date('Y-m-d');     
	//编号主体（YYYYMMDDHHIISSNNNNNNNN）     
	$order_id_main = date('YmdHis') . rand(10000000,99999999);     
	//订单号码主体长度     
	$order_id_len = strlen($order_id_main);     
	$order_id_sum = 0;     
	for($i=0; $i<$order_id_len; $i++)
	{     
		$order_id_sum += (int)(substr($order_id_main,$i,1));     
	}
	//唯一订单号码（YYYYMMDDHHIISSNNNNNNNNCC）     
	$order_id = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);
	return $order_id;
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
 * 方法名：判断访问终端是否手机
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月17日
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
 * 方法名：字符串省略处理！
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月17日
 ***********************************/  
function cutcontent($content,$length=0,$doflag=0)
{
	$cut_length = $length>0?$length:200;

	if($content)
	{
		$tmp_content = str_replace('&nbsp;','',strip_tags(htmlspecialchars_decode(trim($content))));
		$deal_cotent = cut_str($tmp_content,$cut_length);
	}
	else{ $deal_cotent = '';}

	return $deal_cotent;	
}
/***********************************
 * 方法名：
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月10日
 ***********************************/
function htmlcontent($content)
{
	$tmp_content=stripslashes(htmlspecialchars_decode(trim($content)));
	return $tmp_content;	
}
/***********************************
 * 方法名：返回当前的毫秒时间戳
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年9月6日
 ***********************************/
function msectime() {
    list($tmp1, $tmp2) = explode(' ', microtime());
    return (float)sprintf('%.0f', (floatval($tmp1) + floatval($tmp2)) * 1000);
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
 * 方法名：二维数组 按照某一键值排序
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2016年8月8日
 ***********************************/
function auto_array_sort($multi_array,$sort_key,$sort=SORT_ASC)
{ 
	if(is_array($multi_array))
	{ 
		foreach ($multi_array as $row_array)
		{ 
			if(is_array($row_array))
			{ 
				$key_array[] = $row_array[$sort_key]; 
			}
			else
			{ 
				return false; 
			} 
		}
		array_multisort($key_array,$sort,$multi_array);  
		return $multi_array;
	}
	else
	{ 
		return false; 
	}
} 
/***********************************
 * 方法名：根据生日计算年龄
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2016年2月24日
 ***********************************/ 
function birthday($birthday){ 
 $age = strtotime($birthday); 
 if($age === false){ 
  return false; 
 } 
 list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age)); 
 $now = strtotime("now"); 
 list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now)); 
 $age = $y2 - $y1; 
 if((int)($m2.$d2) < (int)($m1.$d1)) 
  $age -= 1; 
 return $age; 
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
?>
