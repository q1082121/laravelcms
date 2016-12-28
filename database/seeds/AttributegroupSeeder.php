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
			array('id'=>1,'name'=>'颜色','type'=>'checkbox','groupitems'=>'','orderid'=>0,'status'=>1,'user_id'=>1),
			array('id'=>2,'name'=>'服装尺码','type'=>'checkbox','groupitems'=>'','orderid'=>0,'status'=>1,'user_id'=>1),
			array('id'=>3,'name'=>'鞋子尺码','type'=>'checkbox','groupitems'=>'','orderid'=>0,'status'=>1,'user_id'=>1),
			array('id'=>4,'name'=>'性别','type'=>'radio','groupitems'=>'','orderid'=>0,'status'=>1,'user_id'=>1),
			array('id'=>5,'name'=>'服装品种','type'=>'radio','groupitems'=>'','orderid'=>0,'status'=>1,'user_id'=>1),
			array('id'=>6,'name'=>'服装面料','type'=>'radio','groupitems'=>'','orderid'=>0,'status'=>1,'user_id'=>1),
			array('id'=>7,'name'=>'服装款式','type'=>'radio','groupitems'=>'','orderid'=>0,'status'=>1,'user_id'=>1)
		);

		/***********************************/
		foreach($attributegroups  as $key => $val)
		{
			\App\Http\Model\Attributegroup::create($val);	
		}

    }
}
