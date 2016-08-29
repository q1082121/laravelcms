<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userinfos', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name',50)->nullable();
			$table->string('nick',50)->nullable();
			$table->tinyInteger('sex')->default(0);
			$table->timestamp('birthday')->nullable();
			$table->string('qq',15)->nullable();
			$table->integer('area_pid')->default(0);
			$table->integer('area_cid')->default(0);
			$table->integer('area_xid')->default(0);
			$table->integer('score')->default(0);
			$table->DECIMAL('money',8,2);
			$table->string('user_id')->unique();
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
        Schema::drop('userinfos');
    }
}
