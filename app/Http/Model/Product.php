<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :产品内容
*******************************************/
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 在 Productattribute 模型中增加一对多关系的函数
	*******************************************/
    public function hasManyProductattributes()
    {
        return $this->hasMany('App\Http\Model\Productattribute', 'product_id', 'id');
    }
}
