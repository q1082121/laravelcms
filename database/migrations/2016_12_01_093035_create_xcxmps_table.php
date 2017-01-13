<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXcxmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('xcxmps', function(Blueprint $table) {
			$table->increments('id');
            $table->string('token',50);					        //token
			$table->string('name',50);					        //小程序名称
            $table->string('appid',50)->nullable();		        //应用ID
            $table->string('appsecret',50)->nullable();	        //应用密钥
            $table->string('mapkey',50)->nullable();	        //腾讯地图服务KEY
            $table->string('mchid',20)->nullable();			    //商户ID
            $table->string('paykey',32)->nullable();			//支付密钥
			$table->text('openid_items')->nullable();	        //消息接受主体
            $table->string('temp_name1',50)->nullable();		//消息模版名称一
            $table->string('temp_id1',50)->nullable();			//消息模版ID一
            $table->string('temp_name2',50)->nullable();		//消息模版名称二
            $table->string('temp_id2',50)->nullable();			//消息模版ID二
            $table->string('temp_name3',50)->nullable();		//消息模版名称三
            $table->string('temp_id3',50)->nullable();			//消息模版ID三
            $table->string('temp_name4',50)->nullable();		//消息模版名称四
            $table->string('temp_id4',50)->nullable();			//消息模版ID四
			$table->tinyInteger('status')->default(0);	//状态
			$table->integer('user_id');					
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
        //
        Schema::drop('xcxmps');
    }
}
