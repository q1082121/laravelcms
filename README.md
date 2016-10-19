
# laravelcms V1.2.0
基于 laravel5.2 的内容管理系统  后台基于AdminLTE主题  前端组件Vue.js

作者:rubbish.boy@163.com
QQ	:471416739

#	使用了laravel哪些扩展包？ composer.json
1. zizaco/entrust 权限验证
2. predis/predis redis-php扩展包
3. overtrue/laravel-lang laravel多个国家的语言包
4. gregwar/captcha 验证码类库
5. barryvdh/laravel-debugbar 调式Debug插件
6. intervention/image 图片处理类库
7. yuanchao/laravel-5-markdown-editor 文本编辑器
8. stevenyangecho/laravel-u-editor 百度富文本编辑器

#	laravel使用了哪些前端组件？ bower.json

	前端组件默认安装存放目录：Public/module
	"AdminLTE": "admin-lte#^2.3.6"
    "jquery": "1.11.0"
    "vue": "^1.0.26"
    "jquery-form": "good-form#*"
    "vue-resource": "^1.0.2"

#	laravel使用了哪些前端组件？ 非包管理
	layer-v2.4 弹层组件
	error 错误页面模板
	login 用户登录,用户注册模板
	DateTimePicker 时间日期控件 兼容移动端

	public/js/common.js 公共函数

#	使用手册
1. 启动 redis-server.exe  

2. 获取项目文件：git clone 或者 github 上下载压缩包

3. 打开项目文件夹 vender :（zizaco/entrust）扩展无法上传至github 所以需要自行进行安装,找到vendor\zizaco目录下的压缩包entrust.zip 解压压缩包至entrust空文件夹中

4. 使用命令行 建立数据库魔法
    php artisan migrate
	
5. 填充网站初始数据(由于地区数据比较多，生成比较慢，预计时间5-10分钟内)	
		1 php artisan db:seed
		
		2 php artisan db:seed --class=UserSeeder		 账号默认密码:111111
		
		3 php artisan db:seed --class=RoleSeeder
		
		4 php artisan db:seed --class=PermissionSeeder
		
		5 php artisan db:seed --class=DistrictSeeder	 数据较大
		
6. 开始体验
	
#	开发进展

	修改密码 
	系统设置
	用户角色
	角色权限
	用户管理
	栏目分类
	用户资料 
	资讯管理 
	图片管理 
	友情链接 
	微信管理 ing
	日志管理 
	消息管理 开发中
	数据图表 开发中

#	注意事项
	请谨慎使用“composer update” 全部更新操作 会重置一些组件的默认配置设置
	可以使用“composer update vender/.....” 选择性更新安装扩展
	
#	打赏小二
![image](https://github.com/q1082121/laravelcms/blob/master/public/images/alipay.jpg)