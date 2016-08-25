<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 存储评论
	****@return : Response
	*******************************************/
    public function store(Request $request)  
	{
		if (Comment::create($request->all())) {
			return redirect()->back();
		} else {
			return redirect()->back()->withInput()->withErrors('评论发表失败！');
		}
	}
}
