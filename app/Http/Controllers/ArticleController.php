<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;

class ArticleController extends Controller
{
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 文章详情页
	****@param  : int  $id
	****@return : Response
	*******************************************/
	public function show($id)  
	{
		return view('article/show')->withArticle(Article::with('hasManyComments')->find($id));
	}
}
