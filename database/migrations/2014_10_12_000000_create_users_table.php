<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
			$table->string('username',50)->unique()->nullable();	//用户名
            $table->string('email')->unique()->nullable();			//邮件	
			$table->string('mobile',15)->unique()->nullable();		//手机
            $table->string('password');								//密码
			$table->tinyInteger('is_lock')->default(0);				//锁	
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
