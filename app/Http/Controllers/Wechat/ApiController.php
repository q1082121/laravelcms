<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :微信通信接口
*******************************************/
namespace App\Http\Controllers\Wechat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use DB;
use Cache;
use Log;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Text;
use EasyWeChat\Message\Image;
use EasyWeChat\Message\News;
use EasyWeChat\Message\Article;

use App\Http\Model\Wechatuser;
use App\Http\Model\Wechat;
class ApiController extends PublicController
{
	public $options;
	public $gid;
	public $openid;
	public $mp;
	public function __construct(Request $request)
	{
		require base_path('vendor').'/autoload.php';

		$id=filter_suffixes($request->route('id'));
		$condition['id']=$id;
		$condition['status']=1;
		$this->mp=object_array(DB::table('wechats')->where($condition)->first());
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
			]
		];

		/**
		* Guzzle 全局设置
		*
		* 更多请参考： http://docs.guzzlephp.org/en/latest/request-options.html
		*/
		$this->options['guzzle']=[
				'timeout' => 3.0, // 超时时间（秒）
				//'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
		];

		if(@$this->mp['type']==4)
		{	
			/**
			* OAuth 配置
			*
			* scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
			* callback：OAuth授权完成后的回调页地址
			*/
			$this->options['oauth']=[
					'scopes'   => ['snsapi_userinfo'],
					'callback' => '/examples/oauth_callback.php',
			];
		}
		if(@$this->mp['mchid']&&@$this->mp['paykey'])
		{
			/**
			* 微信支付
			*/
			$this->options['payment']=[
				'merchant_id'        => @$this->mp['mchid'],
				'key'                => @$this->mp['paykey'],
				'cert_path'          => @$this->mp['cert_path'], 	   // XXX: 绝对路径！！！！
				'key_path'           => @$this->mp['key_path'],        // XXX: 绝对路径！！！！
				// 'device_info'     => '013467007045764',
				// 'sub_app_id'      => '',
				// 'sub_merchant_id' => '',
				// ...
			];
		}


	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :首页
	*******************************************/
	public function index(Request $request)  
	{
		if($this->mp)
		{
			$app = new Application($this->options);
			$server = $app->server;
			$server->setMessageHandler(function($message)
			{
				$this->gid=$gid=$message->ToUserName;
				$this->openid=$openid=$message->FromUserName;

				$condition_wechatuser['wechat_id']=$this->mp['id'];
				$condition_wechatuser['openid']=$this->openid;

				// 注意，这里的 $message 不仅仅是用户发来的消息，也可能是事件
				// 当 $message->MsgType 为 event 时为事件
				if ($message->MsgType == 'event') {
					# code...
					switch ($message->Event) {
						case 'subscribe':
							$result=object_array(Wechatuser::where($condition_wechatuser)->first());
							if(empty($result))
							{
								$params = new Wechatuser;
								$params->wechat_id 	= $this->mp['id'];
								$params->openid 	= $this->openid;
								$params->status 	= 1;
								$params->save();
							}
							else
							{
								$params = Wechatuser::find($result['id']);
								$params->status=1;
								$params->save();
							}
							if($this->mp['subscribe_keyword'])
							{
								$result=search_keyword($this->mp['subscribe_keyword'],$this->mp);
								$reply=$this->result_message($result);
							}
							else if($this->mp['subscribe_text'])
							{
								$reply=$this->mp['subscribe_text'];
							}
							else
							{
								$reply="您好！欢迎关注我,么么哒!";
							}
							return $reply;
							# 订阅
							break;
						case 'unsubscribe':
							$result=object_array(Wechatuser::where($condition_wechatuser)->first());
							if($result)
							{
								$params = Wechatuser::find($result['id']);
								$params->status=0;
								$params->save();
							}
							return "主人不要丢下我!";
							# 取消订阅
							break;
						case 'SCAN':
							# 扫描带参数二维码
							break;
						case 'VIEW':
							# 菜单 - 点击菜单跳转链接
							break;
						case 'CLICK':
							# 菜单 - 点击菜单拉取消息
							break;
						case 'scancode_push':
							# 菜单 - 扫码推事件(客户端跳URL)
							break;
						case 'scancode_waitmsg':
							# 菜单 - 扫码推事件(客户端不跳URL)
							break;
						case 'pic_sysphoto':
							# 菜单 - 弹出系统拍照发图
							break;
						case 'pic_photo_or_album':
							# 菜单 - 弹出拍照或者相册发图
							break;
						case 'pic_weixin':
							# 菜单 - 弹出微信相册发图器
							break;
						case 'location_select':
							# 菜单 - 弹出地理位置选择器
							break;
						case 'LOCATION':
							# 上报地理位置
							break;
						case 'MASSSENDJOBFINISH':
							# 发送结果 - 高级群发完成
							break;
						case 'TEMPLATESENDJOBFINISH':
							# 发送结果 - 模板消息发送结果
							break;
						case 'kfcreatesession':
							# 多客服 - 接入会话
								return new \EasyWeChat\Message\Transfer();
							break;
						case 'kfclosesession':
							# 多客服 - 关闭会话
							break;
						case 'kfswitchsession':
							# 多客服 - 转接会话
								return new \EasyWeChat\Message\Transfer();
							break;
						case 'card_pass_check':
							# 卡券 - 审核通过
							break;
						case 'card_not_pass_check':
							# 卡券 - 审核未通过
							break;							
						case 'user_get_card':
							# 卡券 - 用户领取卡券
							break;	
						case 'user_del_card':
							# 卡券 - 用户删除卡券
							break;	
						default:
							# code...
							break;
					}
				}
				else
				{
					switch ($message->MsgType)
					{
						case 'text':
							$keyword=$message->Content;
							$result=search_keyword($keyword,$this->mp);
							return $this->result_message($result);
							# 文字消息...
							break;
						case 'image':
							# 图片消息...
							break;
						case 'voice':
							# 语音消息...
							break;
						case 'video':
							# 视频消息...
							break;
						case 'location':
							# 坐标消息...
							break;
						case 'link':
							# 链接消息...
							break;
						default:
							# code...
							break;
					}
				}
			});

			$response = $server->serve();
			return $response;


		}
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :处理返回消息
	*******************************************/
	public function result_message($result)
	{
		switch($result['type'])
		{
			case "text":
						$response = new Text(['content' => $result['data']]);
			break;
			case "imagetext":
						$count=count($result['data']);
						if($count==1)
						{
							foreach($result['data'] as $key => $val)
							{
								switch($val['tablename'])
								{
									case "wechatreplyimagetexts":
																	$info=object_array(DB::table($val['tablename'])->whereId($val['field_id'])->first());
																	$datas['title']=$info['title'];	
																	$datas['description']=$info['introduction'];	
																	$datas['url']=$info['linkurl']?$info['linkurl']:"http://www.es12.com";	
																	$datas['image']='http://'.$_SERVER['HTTP_HOST']."/uploads/Wechatreplyimagetext/".$info['attachment'];						
									break;
								}
								
								$response= new News();
								$response->title 			=$datas['title'];
								$response->description 		=$datas['description'];
								$response->url 				=$datas['url'];
								$response->image 			=$datas['image'];
								
							}
						}
						else
						{
							foreach($result['data'] as $key => $val)
							{

								switch($val['tablename'])
								{
									case "wechatreplyimagetexts":
																	$info=object_array(DB::table($val['tablename'])->whereId($val['field_id'])->first());
																	$datas['title']=$info['title'];	
																	$datas['description']=$info['introduction'];	
																	$datas['url']=$info['linkurl']?$info['linkurl']:"http://www.es12.com";	
																	$datas['image']='http://'.$_SERVER['HTTP_HOST']."/uploads/Wechatreplyimagetext/".$info['attachment'];						
									break;
								}
								$response[]= new News([
											'title'       => $datas['title'],
											'description' => $datas['description'],
											'url'         => $datas['url'],
											'image'       => $datas['image'],
										]);
							}
						}
						
						
			break;
		}
		return $response;
	}
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :生成菜单数据
	*******************************************/
	public function create_menu(Request $request)
	{
		if($this->mp)
		{
			$condition_mp['grade']=1;
			$condition_mp['status']=1;
			$menu_top=Wechat::find($this->mp['id'])->hasManyClassifywechats()->where($condition_mp)->orderBy('orderid','asc')->get()->toArray();
			

			$app = new Application($this->options);
			$menu = $app->menu;
			//$menu->add($buttons);

			$info=trans('admin.website_create_success');
			$msg_array['status']='1';
			$msg_array['info']=$info;
			$msg_array['is_reload']=0;
			$msg_array['resource']=$buttons;
		}
		else
		{
			$info=trans('admin.website_create_failure');
			$msg_array['status']='2';
			$msg_array['info']=$info;
			$msg_array['is_reload']=0;
			$msg_array['resource']=$id;
		}
		return response()->json($msg_array);
	}
}
