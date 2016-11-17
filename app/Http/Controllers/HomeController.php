<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :首页控制器
*******************************************/
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//使用数据库操作DB
use DB;
use Session;
use Cache;
use URL;

class HomeController extends PublicController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $website=$this->website;
        $website['modelname']=getCurrentControllerName('Home');
        $website['curnav']=1;
        $website['title']=@$this->root['systitle'];
        $website['apiurl_cache']=URL::action('CacheapiController@api_cache');

        return view('home')->with('website',$website);
    }
}
