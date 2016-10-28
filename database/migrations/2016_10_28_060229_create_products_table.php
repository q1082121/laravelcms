<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('products', function(Blueprint $table) 
		{
			$table->increments('id');
            $table->integer('classid')->default(0);		        //分类
			$table->string('title',100);				        //标题
			$table->string('introduction',150)->nullable();		//导读
			$table->string('sources',30)->nullable();		    //来源
            $table->string('attachment',100)->nullable();		//封面
			$table->tinyInteger('isattach')->default(0);        //是否有封面
            $table->text('content')->nullable();		        //内容
            $table->string('syseditor',20);			            //编辑器代码
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
        Schema::drop('products');
    }
}
