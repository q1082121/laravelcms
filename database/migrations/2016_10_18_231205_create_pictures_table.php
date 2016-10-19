<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pictures', function(Blueprint $table) 
		{
			$table->increments('id');
            $table->integer('modelid')->default(0);		        //分类模块
			$table->string('title',100);				        //标题
            $table->string('attachment',100);			        //封面
			$table->tinyInteger('isattach')->default(0);        //是否有封面
			$table->integer('clicks')->default(0);		        //浏览
			$table->string('linkurl')->nullable();		        //外链接
            $table->integer('orderid')->default(0);		        //排序
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
		Schema::drop('pictures');
    }
}
