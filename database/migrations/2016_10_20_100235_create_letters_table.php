<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('letters', function(Blueprint $table) 
		{
			$table->increments('id');
			$table->string('title',100);				        //标题
            $table->string('attachment',100)->nullable();		//附件
			$table->tinyInteger('isattach')->default(0);        //是否有附件
            $table->string('syseditor',20);			            //编辑器代码
            $table->text('content')->nullable();		        //内容
            $table->string('email_to',100);				        //目标信件地址
            $table->tinyInteger('isstar_to')->default(0);       //目标信件是否标星
            $table->tinyInteger('isoverhead_to')->default(0);   //目标信件是否顶置
            $table->tinyInteger('istrash_to')->default(0);      //目标信件是否进回收站
            $table->tinyInteger('isdel_to')->default(0);        //目标信件删除状态
            $table->string('email_from',100);	                //发送信件地址
            $table->tinyInteger('isstar_from')->default(0);     //发送信件是否标星
            $table->tinyInteger('isoverhead_from')->default(0); //发送信件是否顶置
            $table->tinyInteger('istrash_from')->default(0);    //发送信件是否进回收站
            $table->tinyInteger('isdel_from')->default(0);      //发送信件删除状态
            $table->tinyInteger('status')->default(0);          //阅读状态
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
        Schema::drop('letters');
    }
}
