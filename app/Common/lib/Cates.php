<?php
/***********************************
 * 方法名：自动处理分类select
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月12日
 ***********************************/
namespace App\Common\lib;
class Cates{
    var $opt;
	var $optdata;
	var $optlist;
	var $type=1;
    var $lanmua = array();
    var $lanmub = array();
	
	public function settype($type=1)
	{
		$this->type=$type;
	}

    public function separate($allcates){
        foreach($allcates as $key => $val)
		{
            if($val['topid']){
               $this->lanmub[$val['topid']][$val['id']] = $val;
            } else {
               $this->lanmua[$val['id']] = $val;
            }
        }
    }

	public function opt($allcates,$select=''){
        @$this->lanmua or $this->separate($allcates);
		asort($this->lanmua);
		switch($this->type)
		{
			case 1:
					$this->optdata[0]=array('text'=>'请选择父类','value'=>0);
					break;
			case 2:
					$this->optdata[0]=array('text'=>'请选择分类','value'=>0);
					break;		
		}
		
        foreach(@$this->lanmua as $key => $val){
            $selected = $val['id'] == $select ? " selected" : "";
			$nextgt="|-->";			
            $this->opt .= "<option value='".$val['id']."'".$selected.">+".$val['name']."</option>\r\n";
			$this->optdata[]=array('text'=>'+'.$val['name'],'value'=>$val['id']);
			$val['gtstr']=$nextgt;
			$this->optlist[]=$val;
			
			if(is_array(@$this->lanmub[$val['id']]))
			{
				$this->opts($val['id'],$nextgt,$select);
			}
        }
    }

	public function opts($key,$gt,$select='')
	{	
		if(is_array(@$this->lanmub[$key]))
		{
			ksort($this->lanmub[$key]);
			foreach(@$this->lanmub[$key] as $k => $v)
			{
				$selected = $k == $select ? " selected" : "";	
				$grade=$v['grade'];
				$gtstr="";
				for( $i=2; $i<= $grade ; $i++)
				{
					$gtstr=$gtstr.'---';
				}
				$nextgt ='|--'.$gtstr.'>';				
				$this->opt .= "<option value='".$v['id']."'".$selected.">".$gt.$v['name']."</option>\r\n";
				$this->optdata[]=array('text'=>$gt.$v['name'],'value'=>$v['id']);
				$v['gtstr']=$nextgt;
				$this->optlist[]=$v;
				
				if(is_array(@$this->lanmub[$v['id']]))
				{
					$this->opts($v['id'],$nextgt,$select);
				}
				
			}
		}
    }
	    
}
?>