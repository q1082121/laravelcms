<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('permissions')->delete();
		/***********************************/
		$permissions = array(
		  array('name' => 'add','display_name' => '添加','description' => '添加权限'),
		  array('name' => 'edit','display_name' => '编辑','description' => '编辑操作权限'),
		  array('name' => 'delete','display_name' => '删除','description' => '删除操作权限的'),
		  array('name' => 'search','display_name' => '搜索','description' => '搜索权限'),
		  array('name' => 'set_role','display_name' => '设置角色','description' => ''),
		  array('name' => 'set_lock','display_name' => '设置用户锁','description' => ''),
		  array('name' => 'get_user_role','display_name' => '获取用户角色','description' => ''),
		  array('name' => 'cancel_user_role','display_name' => '取消用户角色','description' => ''),
		  array('name' => 'set_permission','display_name' => '设置权限','description' => ''),
		  array('name' => 'get_role_permission','display_name' => '获取角色权限','description' => ''),
		  array('name' => 'cancel_role_permission','display_name' => '取消角色权限','description' => ''),
		  array('name' => 'set_status','display_name' => '设置状态','description' => ''),
		  array('name' => 'set_default','display_name' => '设置默认','description' => ''),
		  array('name' => 'set_userinfo','display_name' => '设置用户资料','description' => ''),
		  array('name' => 'create_cache_class','display_name' => '生成栏目分类缓存','description' => ''),
		  array('name' => 'create_cache_picture','display_name' => '生成广告图片缓存','description' => ''),
		  array('name' => 'create_cache_link','display_name' => '生成友情链接缓存','description' => ''),
		  array('name' => 'create_cache_class_wechat','display_name' => '生成微信菜单缓存','description' => ''),
		  array('name' => 'model_setting','display_name' => '模块-系统设置','description' => ''),
		  array('name' => 'model_log','display_name' => '模块-日志管理','description' => ''),
		  array('name' => 'model_letter','display_name' => '模块-信件管理','description' => ''),
		  array('name' => 'model_message','display_name' => '模块-消息管理','description' => ''),
		  array('name' => 'model_role','display_name' => '模块-用户角色','description' => ''),
		  array('name' => 'model_permission','display_name' => '模块-角色权限','description' => ''),
		  array('name' => 'model_user','display_name' => '模块-用户管理','description' => ''),
		  array('name' => 'model_navigation','display_name' => '模块-主导航栏','description' => ''),
		  array('name' => 'model_classify','display_name' => '模块-文章分类','description' => ''),
		  array('name' => 'model_article','display_name' => '模块-文章资讯','description' => ''),
		  array('name' => 'model_classifyproduct','display_name' => '模块-产品分类','description' => ''),
		  array('name' => 'model_attributegroup','display_name' => '模块-属性分组','description' => ''),
		  array('name' => 'model_attributevalue','display_name' => '模块-属性值管理','description' => ''),
		  array('name' => 'model_product','display_name' => '模块-产品内容','description' => ''),
		  array('name' => 'model_productattribute','display_name' => '模块-价格属性','description' => ''),
		  array('name' => 'model_expresstemplate','display_name' => '模块-运费模板','description' => ''),
		  array('name' => 'model_picture','display_name' => '模块-广告图片','description' => ''),
		  array('name' => 'model_classifylink','display_name' => '模块-链接分类','description' => ''),
		  array('name' => 'model_link','display_name' => '模块-友情链接','description' => ''),
		  array('name' => 'model_classifyquestion','display_name' => '模块-题目分类','description' => ''),
		  array('name' => 'model_question','display_name' => '模块-题目题库','description' => ''),
		  array('name' => 'model_wechat','display_name' => '模块-微信管理','description' => ''),
		  array('name' => 'model_xcxmp','display_name' => '模块-小程序管理','description' => ''),
		  
		);

		/***********************************/
		foreach($permissions  as $key => $val)
		{
			\App\Http\Model\Permission::create($val);	
		}

    }
}
