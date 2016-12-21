<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXcxcartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('xcxcarts', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('item_id')->default(0);		//商品项目ID
			$table->integer('item_table')->default(0);	//商品项目表
			$table->integer('qty')->default(0);			//数量
			$table->tinyInteger('status')->default(0);	//状态
			$table->integer('xcxuser_id');					
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
        Schema::drop('xcxcarts');
    }
}
