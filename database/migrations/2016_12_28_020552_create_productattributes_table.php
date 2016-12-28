<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductattributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		 Schema::create('productattributes', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->default(0);			//产品ID
			$table->string('name',50);							//名称
			$table->string('price',20)->default(0);		        //价格
			$table->integer('amount')->default(0);				//数量
			$table->integer('selleds')->default(0);				//销售量
			$table->string('attachment',100)->nullable();		//封面
			$table->tinyInteger('isattach')->default(0);        //是否有封面
			$table->text('attributeitems')->nullable();		    //属性值
			$table->integer('orderid')->default(0);				//排序
			$table->tinyInteger('status')->default(0);			//状态
			$table->integer('user_id');					
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
		Schema::drop('productattributes');
    }
}
