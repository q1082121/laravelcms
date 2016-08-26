<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Model\User;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//引用对应的命名空间
use Gregwar\Captcha\CaptchaBuilder;
use Session;

class RegisterController extends Controller
{
	/******************************************
    ****@AuThor : rubbish@163.com
    ****@Title  : 注册页面
    ****@param  : 
    ****@return : Response
    *******************************************/
     public function register()
    {
    	$website['title']="用户注册-网站内容管理系统";
    	$website['copyrights']="XX版权信息";
        return view('user/register')->with('website',$website);
    }

    /******************************************
    ****@AuThor : rubbish@163.com
    ****@Title  : 验证码
    ****@param  : int  $tmp
    ****@return : Response
    *******************************************/
    public function captcha($tmp) 
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 200, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        Session::flash('cmscaptcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();

    }
}
