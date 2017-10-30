
# laravelPCMS V1.6.0 [下载](http://www.tzsuteng.com/Public/uploadfiles/laravelpcms-V1.6.0.zip) 2016-12-29 发布
基于 laravel5.2 的PHP内容管理系统  后台基于AdminLTE主题  前端组件Vue.js 集成基础的微信相关功能。是一个可以快速上手，项目开发的首选工具。

	博客网站：https://www.pocketol.com

	懒人导航：https://www.pocketol.com/#/daoHang

	作者:rubbish.boy@163.com


#	使用了laravel哪些扩展包？ composer.json
1. zizaco/entrust 权限验证
2. predis/predis redis-php扩展包
3. overtrue/laravel-lang laravel多个国家的语言包
4. gregwar/captcha 验证码类库
5. barryvdh/laravel-debugbar 调式Debug插件
6. intervention/image 图片处理类库
7. yuanchao/laravel-5-markdown-editor 文本编辑器
8. stevenyangecho/laravel-u-editor 百度富文本编辑器
9. workerman/phpsocket.io,workerman/workerman  目前开发用的是win版本, 压缩包是linux版本
10. overtrue/wechat: ~3.1	微信扩展包
11. dingo/api	api开发扩展包
12. tymon/jwt-auth  用户api验证扩展包
13. overtrue/laravel-pinyin 中文转拼音
14. overtrue/laravel-shopping-cart 购物车

#	laravelPCMS 使用了哪些前端组件？ bower.json

	前端组件默认安装存放目录：Public/module
	"AdminLTE": "admin-lte#^2.3.6"
    "jquery": "1.11.0"
    "vue": "^1.0.26"
    "jquery-form": "good-form#*"
    "vue-resource": "^1.0.2"

#	laravelPCMS 使用了哪些前端组件？ 非包管理
	layer-v2.4 弹层组件
	error 错误页面模板
	login 用户登录,用户注册模板
	DateTimePicker 时间日期控件 兼容移动端
	moment 时间处理控件
	socket.io-client-1.3.7 web通信
	amazeui	v2.7.2
	amazeui_admin 
	
	public/js/common.js 公共函数
	
#	便捷的API接口开发 API 版本控制 支持 https

	路由方法：
	$api = app('Dingo\Api\Routing\Router');
	$api->version('v1', function ($api) {
		$api->group(['namespace' => 'App\Http\Controllers\Api\V1','domain' => env('API_DOMAIN', '')], function ($api) {
			$api->get('users', ['as' => 'api.users.list', 'uses' => 'UserController@api_list']);
		});
	});
	
	响应方法：
	
	App\Http\Controllers\Api\V1\UserController
	
	[示例](http://api.tzsuteng.com/api/users)
	[Https示例](https://api.tzsuteng.com/api/users)
	
	
#	使用手册
1. 配置说明：如果需要设置 SESSION_DRIVER=redis 那么需要启动 redis-server.exe  默认为file

2. 开发环境：PHP5.6以上 Laravel框架硬性要求 一般集成环境也可以搭建【phpstudy】【Wamp】

3. 本地开发可以映射本地域名至Public目录

4. 获取项目文件：git clone 或者 github 上下载压缩包 

5. 使用命令行 建立数据库魔法
    php artisan migrate
	
6. 填充网站初始数据(由于地区数据比较多，生成比较慢，预计时间5-10分钟内)	
		1 php artisan db:seed 也可以用下面分步骤执行
		
			1 php artisan db:seed --class=UserSeeder		 账号默认密码:111111
		
			2 php artisan db:seed --class=RoleSeeder
		
			3 php artisan db:seed --class=PermissionSeeder
		
			4 php artisan db:seed --class=DistrictSeeder	 数据较大
			
			5 php artisan db:seed --class=AttributegroupSeeder
			
			6 php artisan db:seed --class=AttributevalueSeeder

			(遇到Allowed memory size of) 可以手动导入database/seeds/district.sql
		
7. 开始体验
	[DEMO](http://api.tzsuteng.com)
	
#	开发进展

	修改密码 
	系统设置
	用户角色
	角色权限
	用户管理
	用户资料
	主导航栏
	资讯管理 
	-文章分类
	-文章资讯
	产品管理	
	-产品分类
	-属性分组	
	-产品内容
	-产品价格属性	
	图片管理 
	链接管理 
	-链接分类
	-友情链接
	日志管理 
	信件管理 
	用户头像 
	题库管理	
	-题库分类	
	 -题库类型
	 -单选题
	 -多选题
	 -判断题
	微信管理 	
	>公众号管理 
	>关注回复	
	>默认回复	
	>文本回复	 
	>图文回复	 
	>微信菜单	 
	>粉丝列表	 
	前端会员中心 【目前开发了一些基础功能】
	新！微信小程序
	新！微信小程序登录态维护
	新！微信小程序用户接口
	新！微信小程序名片接口
	新！微信小程序产品接口
	新！微信小程序购物车接口
	新！微信小程序收地地址管理接口
	新！微信小程序购物车结算

#	注意事项
	请谨慎使用“composer update” 全部更新操作 会重置一些组件的默认配置设置
	可以使用“composer update vender/.....” 选择性更新安装扩展
	
#	打赏小二
![image](https://github.com/q1082121/laravelcms/blob/master/public/images/alipay.jpg)

#	示例图片
![image](https://github.com/q1082121/laravelcms/blob/master/public/images/home/demo/1.png)
![image](https://github.com/q1082121/laravelcms/blob/master/public/images/home/demo/8.png)
![image](https://github.com/q1082121/laravelcms/blob/master/public/images/home/demo/2.png)
![image](https://github.com/q1082121/laravelcms/blob/master/public/images/home/demo/5.png)
