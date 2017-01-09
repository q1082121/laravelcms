<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :运费模板
*******************************************/
namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Expresstemplate extends Model
{
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 在 Expressvalue 模型中增加一对多关系的函数
	*******************************************/
    public function hasManyExpressvalues()
    {
        return $this->hasMany('App\Http\Model\Expressvalue', 'expresstemplate_id', 'id');
    }
}
