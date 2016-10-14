<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('districts', function(Blueprint $table) 
		{
			$table->increments('id');
			$table->string('name',50);					//名称
			$table->string('alias',50)->nullable();		//别名
			$table->string('spell',30)->nullable();		//拼音
			$table->string('letter',5)->nullable();		//首字母
			$table->integer('level')->default(0);		//等级
			$table->integer('parentid')->default(0);	//父类
			$table->integer('mdcity')->default(0);		//是否直辖市
			$table->string('zonecode',5)->nullable();	//电话区号
			$table->string('postcode',6)->nullable();	//邮政编码
			$table->string('weathercode',15)->nullable();//天气代码
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
		Schema::drop('districts');
    }
}
