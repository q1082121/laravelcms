<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXcxscoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('xcxscores', function(Blueprint $table) 
        {
			$table->increments('id');
			$table->tinyInteger('type')->default(0);	//类型
            $table->integer('val')->default(0);		    //值
			$table->string('info',150)->nullable();		//描述
            $table->string('tablename',50)->nullable(); //表名称
            $table->integer('keyid')->default(0);       //字段ID
            $table->integer('xcxuser_id')->default(0);	//用户ID
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
		Schema::drop('xcxscores');
    }
}
