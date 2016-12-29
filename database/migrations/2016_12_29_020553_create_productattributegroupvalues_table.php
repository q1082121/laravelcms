<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductattributegroupvaluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		 Schema::create('productattributegroupvalues', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->default(0);			//产品ID
			$table->integer('productattribute_id')->default(0);	//价格属性ID
			$table->string('keyname',50)->nullable();			//键名
			$table->string('keyval',100)->nullable();		    //键值
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
		Schema::drop('productattributegroupvalues');
    }
}
