<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :会员中心
*******************************************/
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Cache;
use App\Http\Model\User;
use App\Http\Model\Userinfo;

class UserController extends PublicController
{
	/******************************************
	****AuThor:rubbish.boy@163.com
	****Title :首页
	*******************************************/
	public function index()  
	{
		
		$website=$this->website;
		$website['cursitename']=trans('user.user_navigation_center');
		$website['title']=$website['cursitename'];

		return view('user/home')->with('website',$website);
	}

}
