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
		  array('name' => 'admin','display_name' => '管理员','type' => 1,'score' => 1,'experience' => 0,'description' => '管理员拥有全部权限'),
		  array('name' => 'areaadmin','display_name' => '区域管理员','type' => 2,'score' => 1,'experience' => 0,'description' => '部分权限限制的'),
		  array('name' => 'subareaadmin','display_name' => '子区域管理员','type' => 3,'score' => 1,'experience' => 0,'description' => '部分权限限制的'),
		  array('name' => 'user_1','display_name' => '见习会员','type' => 4,'level'=> 1,'score' => 1,'experience' => 0,'description' => ''),
		  array('name' => 'user_2','display_name' => '正式会员','type' => 4,'level'=> 2,'score' => 1,'experience' => 10,'description' => ''),
		  array('name' => 'user_3','display_name' => '小有名气','type' => 4,'level'=> 3,'score' => 1,'experience' => 50,'description' => ''),
		  array('name' => 'user_4','display_name' => '知名人士','type' => 4,'level'=> 4,'score' => 1,'experience' => 100,'description' => ''),
		  array('name' => 'user_5','display_name' => '见习写手','type' => 4,'level'=> 5,'score' => 1,'experience' => 150,'description' => ''),
		  array('name' => 'user_6','display_name' => '正式写手','type' => 4,'level'=> 6,'score' => 1,'experience' => 200,'description' => ''),
		  array('name' => 'user_7','display_name' => '著名写手','type' => 4,'level'=> 7,'score' => 1,'experience' => 250,'description' => ''),
		  array('name' => 'user_8','display_name' => '见习作家','type' => 4,'level'=> 8,'score' => 1,'experience' => 300,'description' => ''),
		  array('name' => 'user_9','display_name' => '正式作家','type' => 4,'level'=> 9,'score' => 1,'experience' => 500,'description' => ''),
		  array('name' => 'user_10','display_name' => '职业作家','type' => 4,'level'=> 10,'score' => 1,'experience' => 1000,'description' => ''),
		  array('name' => 'user_11','display_name' => '知名作家','type' => 4,'level'=> 11,'score' => 1,'experience' => 1500,'description' => ''),
		);

		/***********************************/
		foreach($roles  as $key => $val)
		{
			\App\Http\Model\Role::create($val);	
		}
		
		DB::table('role_user')->delete();
		DB::table('role_user')->insert(['user_id' => 1,'role_id' => 1]);
		DB::table('role_user')->insert(['user_id' => 2,'role_id' => 4]);
    }
}
