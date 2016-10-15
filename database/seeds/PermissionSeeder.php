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
		  array('id' => '1','name' => 'add','display_name' => '添加','description' => '添加权限'),
		  array('id' => '2','name' => 'edit','display_name' => '编辑','description' => '编辑操作权限'),
		  array('id' => '3','name' => 'delete','display_name' => '删除','description' => '删除操作权限的'),
		  array('id' => '4','name' => 'search','display_name' => '搜索','description' => '搜索权限'),
		  array('id' => '5','name' => 'set_role','display_name' => '设置角色','description' => ''),
		  array('id' => '6','name' => 'set_lock','display_name' => '设置用户锁','description' => ''),
		  array('id' => '7','name' => 'get_user_role','display_name' => '获取用户角色','description' => ''),
		  array('id' => '8','name' => 'cancel_user_role','display_name' => '取消用户角色','description' => ''),
		  array('id' => '9','name' => 'set_permission','display_name' => '设置权限','description' => ''),
		  array('id' => '10','name' => 'get_role_permission','display_name' => '获取角色权限','description' => ''),
		  array('id' => '11','name' => 'cancel_role_permission','display_name' => '取消角色权限','description' => ''),
		  array('id' => '12','name' => 'set_status','display_name' => '设置状态','description' => ''),
		  array('id' => '13','name' => 'set_userinfo','display_name' => '设置用户资料','description' => ''),
		  array('id' => '14','name' => 'model_setting','display_name' => '模块-系统设置','description' => ''),
		  array('id' => '15','name' => 'model_log','display_name' => '模块-日志管理','description' => ''),
		  array('id' => '16','name' => 'model_message','display_name' => '模块-消息管理','description' => ''),
		  array('id' => '17','name' => 'model_role','display_name' => '模块-用户角色','description' => ''),
		  array('id' => '18','name' => 'model_permission','display_name' => '模块-角色权限','description' => ''),
		  array('id' => '19','name' => 'model_user','display_name' => '模块-用户管理','description' => ''),
		  array('id' => '20','name' => 'model_article','display_name' => '模块-文章资讯','description' => ''),
		  array('id' => '21','name' => 'model_picture','display_name' => '模块-图片管理','description' => ''),
		  array('id' => '22','name' => 'model_links','display_name' => '模块-链接管理','description' => ''),
		  array('id' => '23','name' => 'model_wechat','display_name' => '模块-微信管理','description' => ''),
		  array('id' => '24','name' => 'model_chart','display_name' => '模块-数据图表','description' => ''),
		  array('id' => '25','name' => 'model_class','display_name' => '模块-栏目分类','description' => ''),
		);

		/***********************************/
		foreach($permissions  as $key => $val)
		{
			\App\Http\Model\Permission::create($val);	
		}

    }
}
