<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		//
		DB::table('roles')->delete();
		/***********************************/
		$roles = array(
		  array('name' => 'admin','display_name' => '管理员','description' => '管理员拥有全部权限'),
		  array('name' => 'subadmin','display_name' => '子管理员','description' => '部分权限限制的'),
		  array('name' => 'vip','display_name' => '高级会员','description' => '高级权限可操作'),
		  array('name' => 'user','display_name' => '普通用户组','description' => '普通权限'),
		);

		/***********************************/
		foreach($roles  as $key => $val)
		{
			\App\Http\Model\Role::create($val);	
		}
		
		DB::table('role_user')->delete();
		DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);
    }
}
