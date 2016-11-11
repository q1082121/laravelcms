<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :微信公众号
*******************************************/
namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;

class Wechat extends Model
{
    /******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 在 Classifywechats 模型中增加一对多关系的函数
	*******************************************/
    public function hasManyClassifywechats()
    {
        return $this->hasMany('App\Http\Model\Classifywechat', 'wechat_id', 'id');
    }
    /******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 在 Wechatreplytext 模型中增加一对多关系的函数
	*******************************************/
    public function hasManyWechatreplytexts()
    {
        return $this->hasMany('App\Http\Model\Wechatreplytext', 'wechat_id', 'id');
    }
    /******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 在 Wechatreplyimagetext 模型中增加一对多关系的函数
	*******************************************/
    public function hasManyWechatreplyimagetexts()
    {
        return $this->hasMany('App\Http\Model\Wechatreplyimagetext', 'wechat_id', 'id');
    }
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 在 Wechatuser 模型中增加一对多关系的函数
	*******************************************/
    public function hasManyWechatusers()
    {
        return $this->hasMany('App\Http\Model\Wechatuser', 'wechat_id', 'id');
    }

}
