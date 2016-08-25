<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Article;
use DB;

class ArticleController extends Controller
{
    /******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 文章控制器
	****@return : Response
	*******************************************/
	public function index()  
	{
		/*
		$article = DB::table('articles');
		$insertId = $article->insertGetId(
		    ['title'=>'Laravel-Academy','body'=>'laravelacademy@test.com','user_id'=>1]
		);
		print_r($insertId);
		*/

		$article = Article::select(DB::raw('title,user_id'))->get();
		dd($article);

		return view('admin/article/index')->withArticles(Article::all());
	}
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 新增文章
	****@return : Response
	*******************************************/
	public function create()  
	{
		return view('admin/article/create');
	}
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 存储文章
	****@return : Response
	*******************************************/
	public function store(Request $request)  
	{
		$this->validate($request, [
			'title' => 'required|unique:articles|max:255',
			'body' => 'required',
		]);

		$article = new Article;
		$article->title = $request->get('title');
		$article->body = $request->get('body');
		$article->user_id = $request->user()->id;

		if ($article->save()) {
			return redirect('admin/article');
		} else {
			return redirect()->back()->withInput()->withErrors('保存失败！');
		}
	}
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 编辑文章
	****@param  : int  $id
	****@return : Response
	*******************************************/
	public function edit($id)  
	{
		return view('admin/article/edit')->withArticle(Article::find($id));
	}
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 更新文章数据到数据库
	****@param  : int  $id
	****@return : Response
	*******************************************/
	public function update(Request $request,$id)
	{
		$this->validate($request, [
			'title' => 'required|unique:pages,title,'.$id.'|max:255',
			'body' => 'required',
		]);

		$article = Article::find($id);
		$article->title = $request->get('title');
		$article->body = $request->get('body');
		$article->user_id = $request->user()->id;

		if ($article->save()) {
			return redirect('admin/article');
		} else {
			return redirect()->back()->withInput()->withErrors('保存失败！');
		}
	}
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 删除文章
	****@param  : int  $id
	****@return : Response
	*******************************************/
	public function destroy($id)
	{
		$article = Article::find($id);
		$article->delete();
		
		return redirect('admin/article');
		//return redirect()->back()->withInput()->withErrors('删除成功！');
	}
}
