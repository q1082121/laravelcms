<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechatusers', function(Blueprint $table) {
			$table->increments('id');
			$table->string('openid',50);	                    //用户的唯一标识
            $table->string('nickname',50)->nullable();	        //昵称
            $table->string('nickname_encode',150)->nullable();	//昵称加密
			$table->tinyInteger('sex')->default(0);		        //性别
			$table->string('language',20)->nullable();		    //语言
            $table->string('province',20)->nullable();		    //省份
            $table->string('city',20)->nullable();		        //城市
            $table->string('country',20)->nullable();		    //国籍
            $table->text('headimgurl')->nullable();             //头像
            $table->tinyInteger('subscribe')->default(0);		//是否关注
			$table->integer('score')->default(0);		        //积分
			$table->DECIMAL('money',8,2);				        //钱包
            $table->integer('wechat_id')->default(0);		    //平台公众号ID
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
        Schema::drop('wechatusers');
    }
}
