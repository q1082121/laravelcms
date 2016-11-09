<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatkeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechatkeywords', function(Blueprint $table) {
			$table->increments('id');
			$table->string('type',50);	                        //关键词类型
            $table->string('tablename',50)->nullable();	        //数据表名
            $table->integer('field_id')->default(0);	        //字段ID
			$table->string('field_keyword',30)->nullable();		//语言
            $table->integer('wechat_id')->default(0);		    //平台公众号ID
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
        Schema::drop('wechatkeywords');
    }
}
