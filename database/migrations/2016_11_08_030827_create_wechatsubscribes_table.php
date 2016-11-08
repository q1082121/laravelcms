<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatsubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechatsubscribes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('gid',50);		                    //原始ID
            $table->string('keyword',100)->nullable();	        //回复关键词
            $table->text('content')->nullable();             	//回复内容
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
        Schema::drop('wechatsubscribes');
    }
}
