<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpresstemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		 Schema::create('expresstemplates', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name',50)->nullable();				//名称
			$table->tinyInteger('isdefault')->default(0);       //是否默认
            $table->tinyInteger('ispostage')->default(0);       //是否平邮
            $table->string('price_postage')->default(0);        //平邮费用
            $table->tinyInteger('isexpress')->default(0);       //是否快递
            $table->string('price_express')->default(0);        //快递费用
            $table->tinyInteger('isems')->default(0);           //是否EMS
            $table->string('price_ems')->default(0);            //EMS费用
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
		Schema::drop('expresstemplates');
    }
}
