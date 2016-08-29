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
 * 方法名：获取IP
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月10日
 ***********************************/
function getip()
{
   //php获取ip的算法
	if ($HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"]) 
	{ 
		$ip = $HTTP_SERVER_VARS["HTTP_X_FORWARDED_FOR"]; 
	} 
	elseif ($HTTP_SERVER_VARS["HTTP_CLIENT_IP"]) 
	{ 
		$ip = $HTTP_SERVER_VARS["HTTP_CLIENT_IP"]; 
	}
	elseif ($_SERVER["HTTP_CLIENT_IP"]) 
	{ 
		$ip = $_SERVER["HTTP_CLIENT_IP"]; 
	}
	elseif ($HTTP_SERVER_VARS["REMOTE_ADDR"]) 
	{ 
		$ip = $HTTP_SERVER_VARS["REMOTE_ADDR"]; 
	} 
	elseif ($_SERVER["REMOTE_ADDR"]) 
	{ 
		$ip = $_SERVER["REMOTE_ADDR"]; 
	} 
	elseif ($_SERVER['REMOTE_host']) 
	{
		$ip = $_SERVER['REMOTE_host'];
	}
	elseif (getenv("HTTP_X_FORWARDED_FOR")) 
	{ 
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	} 
	elseif (getenv("HTTP_CLIENT_IP")) 
	{ 
		$ip = getenv("HTTP_CLIENT_IP"); 
	} 
	elseif (getenv("REMOTE_ADDR"))
	{ 
		$ip = getenv("REMOTE_ADDR"); 
	} 
	else 
	{ 
		$ip = "Unknown"; 
	} 

	return $ip;
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
 * 方法名：判断字符串（或值）是不是相同
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月11日
 ***********************************/
function check_true($value1,$value2,$type=1)
{
	$rule=0;
	$returntext="";
	if($value1 && $value2)
	{
		if($value1==$value2)
		{
			$rule=1;
		}
		if($rule==1)
		{
			switch($type)
			{
				case 1:
						$returntext="checked";
						break;	
			}
		}
	}
	return $returntext;
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
 * 方法名：限制查询出显示的的文字数 超出则用...表示！
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月17日
 ***********************************/ 
function cut_str($string, $length, $dot = '...')   
{
	$charset='utf-8';
	if(strlen($string) <= $length)
	{
		return $string;
	}
	$strcut = '';
	if(strtolower($charset) == 'utf-8')
	{
		$n = $tn = $noc = 0;
		while ($n < strlen($string))
		{
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126))
			{
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t < 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if ($noc >= $length)
			{
				break;
			}
		}
		if ($noc > $length)
		{
			$n -= $tn;
		}
		$strcut = substr($string, 0, $n);
	}
	else
	{
		for($i = 0; $i < $length - 3; $i++)
		{
			$strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
		}
	}
	return $strcut.$dot;
}
/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
        if(false === $slice) {
            $slice = '';
        }
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice.'...' : $slice;
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
 * 方法名：查找函数【判断是否存在】
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月23日
 ***********************************/
function detectpromotion2($string,$promotion){ 
$promotionfound=false;
  foreach(explode(",",$string) as $promotiontocheck){    
    if($promotiontocheck==$promotion){ 
      $promotionfound = true; 
    } 
  } 
  return $promotionfound; 
} 
/***********************************
 * 方法名：数据查找函数 【根据键名查找键值】
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月23日
 ***********************************/
function findstrtext($datalist,$promotion)
{ 
  foreach($datalist as $key=>$promotiontocheck)
  {       
    if($key==$promotion){ 
      $text=$promotiontocheck;
	  break;
    }
  } 
  return $text; 
}
/***********************************
 * 方法名：数据查找函数 id=》name 【根据键名查找键值】
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月23日
 ***********************************/
function findstrtext_name($datalist,$promotion)
{ 
  foreach($datalist as $key=>$promotiontocheck)
  {       
    if($promotiontocheck['id']==$promotion){ 
      $text=$promotiontocheck['name'];
	  break;
    }
  } 
  return $text; 
}
/***********************************
 * 方法名：字符串查找函数 【根据键名查找键值】
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月23日
 ***********************************/
function findstrtext2($string,$promotion){ 
$i=1;
  foreach(explode(",",$string) as $promotiontocheck)
  {        
    if($i==$promotion){ 
      $text=$promotiontocheck;
    }
	$i++;
  } 
  return $text; 
}
/**
 * 字符串转换为数组，主要用于把分隔符调整到第二个参数
 * @param  string $str  要分割的字符串
 * @param  string $glue 分割符
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function str2arr($str, $glue = ','){
    return explode($glue, $str);
}

/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 * @param  array  $arr  要连接的数组
 * @param  string $glue 分割符
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function arr2str($arr, $glue = ','){
    return implode($glue, $arr);
}
/***********************************
 * 方法名：获取数组对应名称
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年10月20日
 ***********************************/
function listname($dblist,$tdblist)
{
	$typelist="";
	$arrylist=explode(',',$dblist);
	$typea=1;
	foreach($arrylist as $value)
	{
		$strtype=$typea==1?'':'/';
		$typelist.=$strtype.$tdblist[$value]['title'];
		$typea++;
	}
	return $typelist;
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

/**
 * 请求接口返回内容
 * @param  string $url [请求的URL地址]
 * @param  string $params [请求的参数]
 * @param  int $ipost [是否采用POST形式]
 * @return  string
 */
function juhecurl($url,$params=false,$ispost=0)
{
    $httpInfo = array();
    $ch = curl_init();
 
    curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
    curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
    curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
    if( $ispost )
    {
        curl_setopt( $ch , CURLOPT_POST , true );
        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
        curl_setopt( $ch , CURLOPT_URL , $url );
    }
    else
    {
        if($params){
            curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
        }else{
            curl_setopt( $ch , CURLOPT_URL , $url);
        }
    }
    $response = curl_exec( $ch );
    if ($response === FALSE) {
        echo "cURL Error: " . curl_error($ch);
        return false;
    }
    $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
    $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
    curl_close( $ch );
    return $response;
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
 * 方法名：推送消息方法
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2016年2月24日
 ***********************************/ 
function push_msg($authid,$subroleid,$info)
{
	// 指明给谁推送，为空表示向所有在线用户推送
	if($subroleid>0)
	{
		$to_uid = $authid.$subroleid;
	}
	else
	{
		//获取接受用户类型
		$to_user_type=query_fieldone($authid,'User','authid','role_group');
		switch ($to_user_type) 
		{
			case '3':
				$main_role=query_fieldone($authid,'Userinfo','authid','main_role');
				$to_uid = $authid.$main_role;
				break;
			
			default:
				$to_uid = $authid;
				break;
		}
		
	}
	//dump($to_uid);
	//debug_info($subroleid);
	//debug_info($to_uid);
	// 推送的url地址，上线时改成自己的服务器地址
	$push_api_url = "http://".$_SERVER['SERVER_NAME'].":2121/";
	$post_data = array(
	   'type' => 'publish',
	   'content' => $info,
	   'to' => $to_uid, 
	);
	http_curl_request($push_api_url,$post_data);
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
?>
