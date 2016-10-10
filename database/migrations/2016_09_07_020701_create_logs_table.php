<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('logs', function(Blueprint $table) {
			$table->increments('id');
			$table->tinyInteger('type')->default(0);	//类型
			$table->integer('user_id')->default(0);		//用户ID
			$table->string('name',100)->nullable();		//名称
			$table->string('info',150)->nullable();		//描述
			$table->string('ip',24)->nullable();		//IP
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
		Schema::drop('logs');
    }
}
