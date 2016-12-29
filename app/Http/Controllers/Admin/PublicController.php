<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :公共控制器
*******************************************/
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
use Redis;
use Cache;
use Carbon;
use App\Http\Model\User;
use Redirect;
use Entrust;
use URL;
use Intervention\Image\ImageManagerStatic as Image;

class PublicController extends Controller
{
	protected $userinfo;
	protected $website;
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :后台首页
	*******************************************/
	public function __construct()
	{
		/*
	    |--------------------------------------------------------------------------
	    | 默认消息 - 后台通用参数设置
	    |--------------------------------------------------------------------------
	    |
	    */
		$root=Cache::store('file')->get('root');
		$root['syseditor']=@$root['syseditor']?@$root['syseditor']:"Ueditor";
		$root['systitle']=@$root['systitle']?@$root['systitle']:"LaravelCms";
		$root['syskeywords']=@$root['syskeywords']?@$root['syskeywords']:"";
		$root['sysdescription']=@$root['sysdescription']?@$root['sysdescription']:"";
		$this->website['website_seo_title']=(@$root['systitle']?@$root['systitle']:trans('admin.website_name'));
		$this->website['website_seo_keywords']=@$root['syskeywords'];
		$this->website['website_seo_description']=@$root['sysdescription'];
		$this->website['root']=$this->root=@$root;
		$setting=Cache::store('file')->get('setting');
		/*
	    |--------------------------------------------------------------------------
	    | 默认消息 - 界面设置参数
	    |--------------------------------------------------------------------------
	    |
	    */
		$settingdata['layout_fixed']=0;
		$settingdata['layout_boxed']=0;
		$settingdata['layout_sidebar_collapse']=0;
		$settingdata['layout_expandOnHover']=0;
		$settingdata['layout_control_sidebar_open']=0;
		$settingdata['layout_toggle']=0;
		$settingdata['skin_blue']=0;
		$settingdata['skin_black']=0;
		$settingdata['skin_purple']=0;
		$settingdata['skin_green']=0;
		$settingdata['skin_red']=0;
		$settingdata['skin_yellow']=0;
		$settingdata['skin_blue_light']=0;
		$settingdata['skin_black_light']=0;
		$settingdata['skin_purple_light']=0;
		$settingdata['skin_green_light']=0;
		$settingdata['skin_red_light']=0;
		$settingdata['skin_yellow_light']=0;
		$this->website['setting']=$setting?$setting:$settingdata;
		$this->website['apiurl_setting']=URL::action('Admin\HomeController@api_setting');
		/*
	    |--------------------------------------------------------------------------
	    | 默认消息 - 定义数据
	    |--------------------------------------------------------------------------
	    |
	    */

		//常量定义
		$this->pagesize=$pagesize=env('APP_ADMIN_PAGE_SIZE', 20);					//分页
		$this->is_watermark=$is_watermark=env('APP_IS_WATERMARK', 1);				//是否水印
		$this->is_thumb=$is_thumb=env('APP_IS_THUMB', 1);							//是否缩略图
		$this->thumb_width=$thumb_width=env('APP_THUMB_WIDTH', 200);				//缩略图宽度
		$this->thumb_height=$thumb_height=env('APP_THUMB_HEIGHT', 200);				//缩略图高度
		//默认广告图片模块
		$this->picture_modellist[]=array('text'=>trans('admin.define_model_picture1'),'value'=>1);
		$this->picture_modellist[]=array('text'=>trans('admin.define_model_picture2'),'value'=>2);
		$this->picture_modellist[]=array('text'=>trans('admin.define_model_picture3'),'value'=>3);
		$this->picture_modellist[]=array('text'=>trans('admin.define_model_picture4'),'value'=>4);
		//默认友情链接模块
		$this->link_modellist[]=array('text'=>trans('admin.define_model_link1'),'value'=>1);
		$this->link_modellist[]=array('text'=>trans('admin.define_model_link2'),'value'=>2);
		//默认日志管理模块
		$this->log_modellist[]=array('text'=>trans('admin.define_model_log1'),'value'=>1);
		//默认微信公众号类型
		$this->wechat_modellist[]=array('text'=>trans('admin.define_model_wechat1'),'value'=>1);
		$this->wechat_modellist[]=array('text'=>trans('admin.define_model_wechat2'),'value'=>2);
		$this->wechat_modellist[]=array('text'=>trans('admin.define_model_wechat3'),'value'=>3);
		$this->wechat_modellist[]=array('text'=>trans('admin.define_model_wechat4'),'value'=>4);
		$this->wechat_modellist[]=array('text'=>trans('admin.define_model_wechat5'),'value'=>5);
		//默认微信菜单栏目类型
		$this->wechat_menutype[]=array('text'=>trans('admin.define_model_menu_type1'),'value'=>'click');
		$this->wechat_menutype[]=array('text'=>trans('admin.define_model_menu_type2'),'value'=>'view');
		$this->wechat_menutype[]=array('text'=>trans('admin.define_model_menu_type3'),'value'=>'scancode_push');
		$this->wechat_menutype[]=array('text'=>trans('admin.define_model_menu_type4'),'value'=>'scancode_waitmsg');
		$this->wechat_menutype[]=array('text'=>trans('admin.define_model_menu_type5'),'value'=>'pic_sysphoto');
		$this->wechat_menutype[]=array('text'=>trans('admin.define_model_menu_type6'),'value'=>'pic_photo_or_album');
		$this->wechat_menutype[]=array('text'=>trans('admin.define_model_menu_type7'),'value'=>'pic_weixin');
		$this->wechat_menutype[]=array('text'=>trans('admin.define_model_menu_type8'),'value'=>'location_select');
		//默认表单类型
		$this->fieldtype_modellist[]=array('text'=>trans('admin.fieldname_item_type_radio'),'value'=>'radio');
		$this->fieldtype_modellist[]=array('text'=>trans('admin.fieldname_item_type_text'),'value'=>'text');
		/*
		$this->fieldtype_modellist[]=array('text'=>trans('admin.fieldname_item_type_checkbox'),'value'=>'checkbox');
		$this->fieldtype_modellist[]=array('text'=>trans('admin.fieldname_item_type_select'),'value'=>'select');
		*/
		//默认显示类型
		$this->displaytype_modellist[]=array('text'=>trans('admin.fieldname_item_displaytype1'),'value'=>1);
		$this->displaytype_modellist[]=array('text'=>trans('admin.fieldname_item_displaytype2'),'value'=>2);

		/*
	    |--------------------------------------------------------------------------
	    | 默认消息 - 验证信息
	    |--------------------------------------------------------------------------
	    |
	    */
		$guard="admin";
	    if (Auth::guard($guard)->check()) 
        {
        	//获取用户信息
            $this->user=$user=Auth::guard($guard)->user();
			$this->userinfo=$userinfo=action_cache($user['id'],'userinfo');
			$this->userinfo['avatar']=$this->userinfo['isattach']==1?"/uploads/User/".$this->userinfo['attachment']:"/images/avatar/200.png";
			$this->website['website_userinfo']=$this->userinfo;
			$this->website['website_user']=$this->user;

			/*
			|--------------------------------------------------------------------------
			| 默认消息 - 用户角色组判断
			|--------------------------------------------------------------------------
			|
			*/
			if(Entrust::hasRole(['admin', 'areaadmin', 'subareaadmin']) == false )
			{
				alert('/',trans('admin.message_userrole_failure'));
			}
			else
			{
				//获取未读信件
				$condition_index['email_to']=$this->user['email'];
				$condition_index['istrash_to']=0;
				$condition_index['isdel_to']=0;
				$condition_index['status']=0;
				$letters_count=DB::table('letters')->where($condition_index)->count();
				$letters_list=DB::table('letters')->where($condition_index)->take(5)->get();
				$this->website['letters_count']=$letters_count?$letters_count:0;
				$this->website['letters_list']=json_encode(object_array($letters_list));

				//获取用户组信息
				$this->roleinfo=$roleinfo=action_cache($user['id'],'userrole');
				$this->website['website_roleinfo']=$this->roleinfo;
			}


        }
		else
		{	
				//alert('/user/login',trans('admin.message_userrole_login'));
				Redirect::to('/user/login')->send();
		}
        
		
	}
	

}
