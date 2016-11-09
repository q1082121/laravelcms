<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatreplytextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechatreplytexts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('keyword',50);	                    //关键词
			$table->text('content')->nullable();				//内容
            $table->integer('wechat_id')->default(0);		    //平台公众号ID
			$table->tinyInteger('status')->default(0);		    //状态
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
        Schema::drop('wechatreplytexts');
    }
}
