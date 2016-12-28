<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributevaluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		 Schema::create('attributevalues', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('attributegroup_id')->default(0);	//属性组ID
			$table->string('name',50);							//名称
			$table->string('val',20)->nullable();	    		//值
			$table->integer('orderid')->default(0);				//排序
			$table->tinyInteger('status')->default(0);			//状态
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
		Schema::drop('attributevalues');
    }
}
