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
            $table->string('attachment',100);			        //附件
			$table->tinyInteger('isattach')->default(0);        //是否有附件
            $table->tinyInteger('isstar')->default(0);          //是否标星
            $table->tinyInteger('isoverhead')->default(0);      //是否顶置
            $table->tinyInteger('istrash')->default(0);         //是否进回收站
            $table->string('syseditor',20);			            //编辑器代码
            $table->text('content')->nullable();		        //内容
            $table->tinyInteger('status')->default(0);          //状态
            $table->integer('to_user_id');				        //接受者
            $table->integer('user_id');	                        //发送者
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
