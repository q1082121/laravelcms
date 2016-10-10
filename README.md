
# laravelcms V1.1.0 
基于 laravel5.2 的内容管理系统  后台基于AdminLTE主题  前端组件Vue.js

#	使用了laravel哪些扩展包？ composer.json
1. zizaco/entrust 权限验证
2. predis/predis redis-php扩展包
3. overtrue/laravel-lang laravel多个国家的语言包
4. gregwar/captcha 验证码类库
5. barryvdh/laravel-debugbar 调式Debug插件

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
	
	public/js/common.js 公共函数

#	使用手册

1. 启动 redis-server.exe  

2.1（zizaco/entrust）扩展无法上传至github 所以需要自行进行安装
    安装使用教程 https://github.com/Zizaco/entrust 

2.2 使用命令行 建立数据库魔法
    php artisan migrate

3. 注册用户(当前默认为用户名注册)已扩展 Email Mobile 注册字段
4. 登录后台
5. 设置角色权限
6. 设置用户角色

#	开发进展

+系统设置
+用户角色
+角色权限
+用户管理
+栏目分类