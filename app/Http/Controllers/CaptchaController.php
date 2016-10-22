<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :验证码接口
*******************************************/
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//引用对应的命名空间
use Gregwar\Captcha\CaptchaBuilder;
use Session;

class CaptchaController extends Controller
{
    //
    /******************************************
    ****@AuThor : rubbish.boy@163.com
    ****@Title  : 注册验证码
    ****@param  : int  $tmp
    ****@return : Response
    *******************************************/
    public function register($tmp) 
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 200, $height = 40, $font = null );
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        Session::flash('register_captcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();

    }
    /******************************************
    ****@AuThor : rubbish.boy@163.com
    ****@Title  : 登录验证码
    ****@param  : int  $tmp
    ****@return : Response
    *******************************************/
    public function login($tmp) 
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 200, $height = 40, $font = null );
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        Session::flash('login_captcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();

    }
}
