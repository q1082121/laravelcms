<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 在 Article 模型中增加一对多关系的函数
	*******************************************/
	public function hasManyComments()
    {
        return $this->hasMany('App\Comment', 'article_id', 'id');
    }
}
