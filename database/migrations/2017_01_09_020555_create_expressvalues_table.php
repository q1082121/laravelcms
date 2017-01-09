<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpressvaluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		 Schema::create('expressvalues', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('expresstemplate_id')->default(0);	//运费模版ID
			$table->string('name',50);							//名称
			$table->string('price',20)->nullable();	    		//价格
			$table->string('area_items',50);					//地区项
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
		Schema::drop('expressvalues');
    }
}
