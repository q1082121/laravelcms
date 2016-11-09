<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('wechats', function(Blueprint $table) {
			$table->increments('id');
            $table->string('token',50);					        //token
			$table->string('name',50);					        //公众号名称
            $table->string('wechataccount',50)->nullable();     //微信号
            $table->string('gid',30);			                //原始ID
			$table->tinyInteger('type')->default(0);	        //公众号类型
            $table->string('appid',50)->nullable();		        //应用ID
            $table->string('appsecret',50)->nullable();	        //应用密钥
            $table->string('encodingaeskey',50)->nullable();    //消息加解密密钥
            $table->string('attachment',100)->nullable();       //封面
			$table->tinyInteger('isattach')->default(0);        //是否有封面
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
            $table->text('subscribe_text')->nullable();	        //关注回复文本
            $table->string('subscribe_keyword',50)->nullable();//关注回复关键词
            $table->text('default_text')->nullable();	        //默认回复文本
            $table->string('default_keyword',50)->nullable();   //默认回复关键词
            $table->text('image_default_text')->nullable();         //图片触发默认回复文本
            $table->string('image_default_keyword',50)->nullable(); //图片触发默认回复关键词
            $table->text('voice_default_text')->nullable();         //声音触发默认回复文本
            $table->string('voice_default_keyword',50)->nullable(); //声音触发默认回复关键词
            $table->text('video_default_text')->nullable();         //视频触发默认回复文本
            $table->string('video_default_keyword',50)->nullable(); //视频触发默认回复关键词
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
        Schema::drop('wechats');
    }
}
