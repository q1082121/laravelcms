<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 给 Comment 类增加 $fillable 成员变量  【批量赋值】
	*******************************************/
	protected $fillable = ['nickname', 'email', 'website', 'content', 'article_id'];
	
}
