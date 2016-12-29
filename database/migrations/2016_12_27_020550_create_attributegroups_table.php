<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributegroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		 Schema::create('attributegroups', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name',50);					    //键值
            $table->string('display_name')->nullable();     //名称
			$table->string('type',20)->nullable();	        //类型
            $table->tinyInteger('display_type')->default(0);//显示类型
			$table->string('groupitems',100)->nullable();   //所属归类
			$table->integer('orderid')->default(0);		    //排序
			$table->tinyInteger('status')->default(0);	    //状态
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
		Schema::drop('attributegroups');
    }
}
