<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
			$table->string('username',50)->unique()->nullable();
            $table->string('email')->unique()->nullable();
			$table->string('mobile',15)->unique()->nullable();
            $table->string('password');
			$table->tinyInteger('role_group')->default(0);
			$table->tinyInteger('is_lock')->default(0);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
