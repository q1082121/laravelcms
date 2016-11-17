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

        /*******************
        +每日登录获取经验值 【      
        ********************/
        $login_condition['type']=1;
        $login_condition['user_id']=1;
        $startTime = date('Y-m-d'.' 00:00:00',time());
        $endTime   = date('Y-m-d'.' 23:59:59',time());
        $is_get_today_experience=object_array(DB::table('experiences')->where($login_condition)->whereBetween('created_at', [$startTime, $endTime])->count());
        /*******************
            +          】      
        ********************/

        dump($is_get_today_experience);

        return view('home')->with('website',$website);
    }
}
