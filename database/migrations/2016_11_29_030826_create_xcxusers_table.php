<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXcxusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xcxusers', function(Blueprint $table) {
			$table->increments('id');
            $table->string('nickname',50)->nullable();	        //昵称
            $table->string('nickname_encode',150)->nullable();	//昵称加密
			$table->tinyInteger('gender')->default(0);		    //性别
            $table->string('province',20)->nullable();		    //省份
            $table->string('city',20)->nullable();		        //城市
            $table->string('country',20)->nullable();		    //国籍
            $table->text('avatarurl')->nullable();              //头像
			$table->integer('score')->default(0);		        //积分
			$table->DECIMAL('money',8,2);				        //钱包
			$table->string('openid',50);	                    //用户的唯一标识
            $table->string('unionid',50);	                    //UnionID
            $table->tinyInteger('status')->default(0);		    //状态	
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
        Schema::drop('xcxusers');
    }
}
