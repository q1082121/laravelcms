<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXcxaddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('xcxaddresses', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name',50)->nullable();		//姓名
			$table->string('mobile',20)->nullable();	//手机号码
			$table->integer('area_pid')->default(0);	//省份
			$table->string('area_pname',30)->nullable();//省份名称
			$table->integer('area_cid')->default(0);	//市级
			$table->string('area_cname',30)->nullable();//市级名称
			$table->integer('area_xid')->default(0);	//县区
			$table->string('area_xname',30)->nullable();//县区名称
            $table->string('address',100)->nullable();	//详情地址
            $table->tinyInteger('isdefault')->default(0);//默认
			$table->tinyInteger('status')->default(0);	//状态
			$table->integer('xcxuser_id');					
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
        Schema::drop('xcxaddresses');
    }
}
