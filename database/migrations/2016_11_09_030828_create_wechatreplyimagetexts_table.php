<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatreplyimagetextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechatreplyimagetexts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('keyword',50);	                    //关键词
            $table->string('title',100);	                    //标题
            $table->string('introduction',150);	                //导读
            $table->string('attachment',50);	                //封面
            $table->tinyInteger('isattach')->default(0);		//是否封面
			$table->text('content')->nullable();				//内容
            $table->string('syseditor',20);			            //编辑器代码
            $table->text('linkurl')->nullable();				//外链接
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
        Schema::drop('wechatreplyimagetexts');
    }
}
