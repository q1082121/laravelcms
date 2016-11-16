<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('users')->delete();
		/***********************************/
		$users = array(
		  array('username' => 'admin','email' => 'rubbish.boy@163.com','mobile' => NULL,'password' => '$2y$10$U0dVKJBNjQn7lkwCtQjDROGbyURoby0nT/8o30Yr0uhmpyMU3CDb.','is_lock' => '0','remember_token' => 'LT9ywRFzVzMzUVURXsvO7CiqQigDrovNCsW9WpPZKfZP9dXv09Vep187V9np'),
		  array('username' => 'demo','email' => '471416739@qq.com','mobile' => NULL,'password' => '$2y$10$lGIkegbR0q9S5yIlTPxwfuWsH40vZsP053oqjOcNwuZw9XLdpd.YS','is_lock' => '0','remember_token' => '')
		);
		/***********************************/
		foreach($users  as $key => $val)
		{
			\App\Http\Model\User::create($val);	
		}
		
		DB::table('userinfos')->delete();
		$userinfos = array(
		  array('name' => NULL,'nick' => '管理员','sex' => '0','birthday' => NULL,'qq' => NULL,'area_pid' => '0','area_cid' => '0','area_xid' => '0','score' => '0','money' => '0.00','user_id' => '1','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")),
			array('name' => NULL,'nick' => '小呆瓜','sex' => '0','birthday' => NULL,'qq' => NULL,'area_pid' => '0','area_cid' => '0','area_xid' => '0','score' => '0','money' => '0.00','user_id' => '2','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
		);
		foreach($userinfos  as $key => $val)
		{
			DB::table('userinfos')->insert($val);
		}
		
    }
}
