<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :微信通信接口
*******************************************/
namespace App\Http\Controllers\Wechat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Cache;
use Log;
use EasyWeChat\Foundation\Application;
class ApiController extends PublicController
{
	public $options;
	public $gid;
	public $mp;
	public function __construct()
	{
		
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :首页
	*******************************************/
	public function index(Request $request)  
	{
		$this->gid=filter_suffixes($request->route('gid'));
		$condition['gid']=$this->gid;
		$condition['status']=1;
		$this->mp=object_array(DB::table('wechats')->where($condition)->first());
		if($this->mp)
		{
			$this->options = [
				/**
				* Debug 模式，bool 值：true/false
				*
				* 当值为 false 时，所有的日志都不会记录
				*/	
				'debug'  => true,
				/**
				* 账号基本信息，请从微信公众平台/开放平台获取
				*/
				'app_id' => @$this->mp['appid'],			 	// AppID	
				'secret' => @$this->mp['appsecret'],		 	// AppSecret	
				'token'  => @$this->mp['token'],			 	// Token
				'aes_key' => @$this->mp['encodingaeskeynull'],	// EncodingAESKey，安全模式下请一定要填写！！！
				/**
				* 日志配置
				*
				* level: 日志级别, 可选为：
				*         debug/info/notice/warning/error/critical/alert/emergency
				* file：日志文件位置(绝对路径!!!)，要求可写权限
				*/
				'log' => [
					'level' => 'debug',
					'file'  => base_path('tmp').'/logs/easywechat.log', // XXX: 绝对路径！！！！
				],
				/**
				* OAuth 配置
				*
				* scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
				* callback：OAuth授权完成后的回调页地址
				*/
				//'oauth' => [
				//	'scopes'   => ['snsapi_userinfo'],
				//	'callback' => '/examples/oauth_callback.php',
				//],
				/**
				* 微信支付
				*/
				//'payment' => [
				//	'merchant_id'        => @$this->mp['mchid'],
				//	'key'                => @$this->mp['paykey'],
				//	'cert_path'          => @$this->mp['cert_path'], 	   // XXX: 绝对路径！！！！
				//	'key_path'           => @$this->mp['key_path'],      // XXX: 绝对路径！！！！
					// 'device_info'     => '013467007045764',
					// 'sub_app_id'      => '',
					// 'sub_merchant_id' => '',
					// ...
				//],
				/**
				* Guzzle 全局设置
				*
				* 更多请参考： http://docs.guzzlephp.org/en/latest/request-options.html
				*/
				//'guzzle' => [
				//	'timeout' => 3.0, // 超时时间（秒）
					//'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
				//]

			];
			$app = new Application($this->options);
			$app->server->setMessageHandler(function($message){
					return "欢迎关注 overtrue！";
			});
			$response = $app->server->serve();
			return $response;
		}
		

	}
}
