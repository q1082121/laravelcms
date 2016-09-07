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
			$table->tinyInteger('type')->default(0);
			$table->integer('user_id')->default(0);
			$table->string('name',100)->nullable();
			$table->string('info',150)->nullable();
			$table->string('ip',24)->nullable();
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
