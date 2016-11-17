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
			$table->string('name',50)->nullable();		//姓名
			$table->string('nick',50)->nullable();		//昵称
			$table->tinyInteger('sex')->default(0);		//性别
			$table->date('birthday')->nullable();	    //生日
			$table->string('qq',15)->nullable();		//QQ
            $table->string('attachment',50)->nullable();//头像
            $table->tinyInteger('isattach')->default(0);//是否有头像
			$table->integer('area_pid')->default(0);	//省级
			$table->integer('area_cid')->default(0);	//市级
			$table->integer('area_xid')->default(0);	//县级
            $table->integer('experience')->default(0);  //经验值
			$table->integer('score')->default(0);		//积分
			$table->DECIMAL('money',8,2);				//钱包	
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
