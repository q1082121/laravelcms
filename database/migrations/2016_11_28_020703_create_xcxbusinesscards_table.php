<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXcxbusinesscardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('xcxbusinesscards', function(Blueprint $table) 
        {
			$table->increments('id');
			$table->string('name',20)->nullable();		//姓名
            $table->string('initials',10)->nullable();	//首字母
            $table->string('pinyin',100)->nullable();   //拼音
            $table->string('mobile',13)->nullable(); 	//手机号码
            $table->string('qq',15)->nullable(); 	    //QQ
            $table->string('email',50)->nullable(); 	//邮箱
            $table->string('fax',20)->nullable(); 	    //传真
			$table->string('company',100)->nullable(); 	//公司
			$table->string('address',150)->nullable(); 	//联系地址
            $table->integer('xcxuser_id');              //用户ID
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
		Schema::drop('xcxbusinesscards');
    }
}
