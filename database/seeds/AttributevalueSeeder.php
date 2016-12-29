<?php

use Illuminate\Database\Seeder;

class AttributevalueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('attributevalues')->delete();
		/***********************************/
		$attributevalues = array(
		    array('attributegroup_id'=>1,'name'=>'白色','val'=>'#ffffff','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>1,'name'=>'黑色','val'=>'#000000','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>1,'name'=>'红色','val'=>'#d71345','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>1,'name'=>'橙色','val'=>'#f47920','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>1,'name'=>'灰色','val'=>'#77787b','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>1,'name'=>'绿色','val'=>'#45b97c','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>1,'name'=>'蓝色','val'=>'#145b7d','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>1,'name'=>'青色','val'=>'#009ad6','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>1,'name'=>'紫色','val'=>'#8552a1','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>1,'name'=>'黄色','val'=>'#ffd400','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>1,'name'=>'褐色','val'=>'#843900','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>1,'name'=>'桃色','val'=>'#f58f98','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>1,'name'=>'金色','val'=>'#c37e00','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>2,'name'=>'XXS','val'=>'XXS','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>2,'name'=>'XS','val'=>'XS','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>2,'name'=>'S','val'=>'S','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>2,'name'=>'M','val'=>'M','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>2,'name'=>'L','val'=>'L','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>2,'name'=>'XL','val'=>'XL','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>2,'name'=>'XXL','val'=>'XXL','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>3,'name'=>34,'val'=>34,'orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>3,'name'=>35,'val'=>35,'orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>3,'name'=>36,'val'=>36,'orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>3,'name'=>37,'val'=>37,'orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>3,'name'=>38,'val'=>38,'orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>3,'name'=>39,'val'=>39,'orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>3,'name'=>40,'val'=>40,'orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>3,'name'=>41,'val'=>41,'orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>3,'name'=>42,'val'=>42,'orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>3,'name'=>43,'val'=>43,'orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>3,'name'=>44,'val'=>44,'orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>3,'name'=>45,'val'=>45,'orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>3,'name'=>46,'val'=>46,'orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>4,'name'=>'男','val'=>'男','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>4,'name'=>'女','val'=>'女','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>5,'name'=>'上衣','val'=>'上衣','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>5,'name'=>'衬衫','val'=>'衬衫','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>5,'name'=>'短裤','val'=>'短裤','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>5,'name'=>'T恤','val'=>'T恤','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>5,'name'=>'睡衣','val'=>'睡衣','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>5,'name'=>'长裤','val'=>'长裤','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>5,'name'=>'童装','val'=>'童装','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>6,'name'=>'棉织物','val'=>'棉织物','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>6,'name'=>'毛织物','val'=>'毛织物','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>6,'name'=>'皮革','val'=>'皮革','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>6,'name'=>'麻织物','val'=>'麻织物','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>6,'name'=>'丝织物','val'=>'丝织物','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>7,'name'=>'圆领','val'=>'圆领','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>7,'name'=>'尖领','val'=>'尖领','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>7,'name'=>'方领','val'=>'方领','orderid'=>0,'status'=>1,'user_id'=>1),
			array('attributegroup_id'=>7,'name'=>'倒挂领','val'=>'倒挂领','orderid'=>0,'status'=>1,'user_id'=>1)
		  
		);

		/***********************************/
		foreach($attributevalues  as $key => $val)
		{
			\App\Http\Model\Attributevalue::create($val);	
		}

    }
}
