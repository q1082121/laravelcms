<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :题目
*******************************************/
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 在 Classifywechats 模型中增加一对多关系的函数
	*******************************************/
    public function hasManyQuestionoptions()
    {
        return $this->hasMany('App\Http\Model\Questionoption', 'qid', 'id');
    }
}
