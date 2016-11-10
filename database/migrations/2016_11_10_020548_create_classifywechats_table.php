<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassifywechatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		 Schema::create('classifywechats', function(Blueprint $table) {
			$table->increments('id');
            $table->string('type',50);					//分类类型
			$table->string('name',50);					//分类名称
            $table->string('keyword',50);			    //分类关键词
			$table->string('ico',50)->nullable();		//图标
			$table->integer('bcid')->default(0);		//大类ID
			$table->integer('scid')->default(0);		//小类ID
			$table->integer('topid')->default(0);		//父类ID
			$table->tinyInteger('grade')->default(0);	//分类级别
			$table->text('node')->nullable();			//分类从属过程
            $table->text('linkurl')->nullable();		//外链接
			$table->integer('orderid')->default(0);		//排序
			$table->tinyInteger('status')->default(0);	//状态
			$table->integer('wechat_id');					
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
		Schema::drop('classifywechats');
    }
}
