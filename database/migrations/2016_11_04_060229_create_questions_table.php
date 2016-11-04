<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('questions', function(Blueprint $table) 
		{
			$table->increments('id');
            $table->integer('classid')->default(0);		        //分类
			$table->string('title',100);				        //标题
			$table->tinyInteger('type')->default(0);       		//题目类型
            $table->string('attachment',100)->nullable();		//封面
			$table->tinyInteger('isattach')->default(0);        //是否有封面
            $table->string('score',10)->default(0);				//分数
			$table->tinyInteger('is_answer')->default(0);       //是否答案
            $table->tinyInteger('status')->default(0);          //状态
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
        Schema::drop('questions');
    }
}
