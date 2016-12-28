<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :属性分组
*******************************************/
namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Attributegroup extends Model
{
    //
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 在 Attributevalue 模型中增加一对多关系的函数
	*******************************************/
    public function hasManyAttributevalues()
    {
        return $this->hasMany('App\Http\Model\Attributevalue', 'attributegroup_id', 'id');
    }
}
