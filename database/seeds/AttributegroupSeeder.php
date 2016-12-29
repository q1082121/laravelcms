<?php

use Illuminate\Database\Seeder;

class AttributegroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('attributegroups')->delete();
		/***********************************/
		$attributegroups = array(
			array('id'=>1,'name'=>'arr_color','display_name'=>'颜色','type'=>'radio','display_type'=>1,'groupitems'=>'','orderid'=>0,'status'=>1,'user_id'=>1),
			array('id'=>2,'name'=>'arr_clothing_size','display_name'=>'服装尺码','type'=>'radio','display_type'=>1,'groupitems'=>'','orderid'=>0,'status'=>1,'user_id'=>1),
			array('id'=>3,'name'=>'arr_shoes_size','display_name'=>'鞋子尺码','type'=>'radio','display_type'=>1,'groupitems'=>'','orderid'=>0,'status'=>1,'user_id'=>1),
			array('id'=>4,'name'=>'arr_sex','display_name'=>'性别','type'=>'radio','display_type'=>2,'groupitems'=>'','orderid'=>0,'status'=>1,'user_id'=>1),
			array('id'=>5,'name'=>'arr_clothing_varieties','display_name'=>'服装品种','type'=>'radio','display_type'=>2,'groupitems'=>'','orderid'=>0,'status'=>1,'user_id'=>1),
			array('id'=>6,'name'=>'arr_clothing_fabrics','display_name'=>'服装面料','type'=>'radio','display_type'=>2,'groupitems'=>'','orderid'=>0,'status'=>1,'user_id'=>1),
			array('id'=>7,'name'=>'arr_clothing_styles','display_name'=>'服装款式','type'=>'radio','display_type'=>2,'groupitems'=>'','orderid'=>0,'status'=>1,'user_id'=>1)
		);

		/***********************************/
		foreach($attributegroups  as $key => $val)
		{
			\App\Http\Model\Attributegroup::create($val);	
		}

    }
}
