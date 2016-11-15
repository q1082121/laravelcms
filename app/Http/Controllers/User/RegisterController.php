<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :用户注册
*******************************************/
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
//引用对应的控制器
use App\Http\Controllers\Controller;

//引用对应的数据模型
use App\Http\Model\User;
use App\Http\Model\Userinfo;

//引用对应的命名空间
use Validator;
use Session;
use Cache;
//使用数据库操作DB
use DB;

class RegisterController extends Controller
{
	/******************************************
    ****@AuThor : rubbish.boy@163.com
    ****@Title  : 注册页面
    ****@param  : 
    ****@return : Response
    *******************************************/
     public function register(Request $request)
    {
    	$website['title']=trans('register.name');
        $website['register_name']=trans('register.name');
        $website['website_center_tip']=trans('admin.website_center_tip');
        $website['copyrights']=trans('admin.website_name').trans('admin.website_rightinfo');
        $website['type']=$request->route('type')?$request->route('type'):2;
        $root=Cache::store('file')->get('root');
		$root['systitle']=@$root['systitle']?@$root['systitle']:"LaravelCms";
		$root['syskeywords']=@$root['syskeywords']?@$root['syskeywords']:"";
		$root['sysdescription']=@$root['sysdescription']?@$root['sysdescription']:"";
        $website['root']=$root;
        return view('user/register')->with('website',$website);
    }
    /******************************************
    ****@AuThor : rubbish.boy@163.com
    ****@Title  : 注册写入
    ****@param  : $request
    ****@return : Response
    *******************************************/
    public function store(Request $request)
    {
        $code = $request->get('code');
        if (Session::get('register_captcha') == $code) 
        {
            $rule=0;
            
            $success_msg=trans('register.success');
            $errory_msg=trans('register.failure');

            switch ($request->get('type')) 
            {
                case 1:
                    $user_email = DB::table('users')->where('email', $request->get('email'))->first();
                    if($user_email)
                    {
                        $rule=11;
                        $errory_msg=trans('register.failure11');
                    }
                    break;
                case 2:
                    $username = DB::table('users')->where('username', $request->get('username'))->first();
                    $user_email = DB::table('users')->where('email', $request->get('email'))->first();
                    if($username)
                    {
                        $rule=12;
                        $errory_msg=trans('register.failure12');
                    }
                    else if($user_email)
                    {
                        $rule=11;
                        $errory_msg=trans('register.failure11');
                    }
                    break;
                case 3:
                    $user_mobile = DB::table('users')->where('mobile', $request->get('mobile'))->first();
                    if($user_mobile)
                    {
                        $rule=13;
                        $errory_msg=trans('register.failure13');
                    }
                    break;    
                default:
                        
                    break;
            }
            if($rule<10)
            {
                DB::beginTransaction();
                try
                { 
                    //中间逻辑代码
                    $user = new User;
                    $user->email = $request->get('email');
                    $user->username = $request->get('username');
                    $user->mobile = $request->get('mobile');
                    $user->password = bcrypt($request->get('userpwd'));
                    $user->remember_token = "";
                    $user->is_lock = 0;
                    if ($user->save()) 
                    {
                        $user_id=$user->id;

                        $userinfo=new Userinfo;
                        $userinfo->user_id = $user_id;

                        if($userinfo->save())
                        {
                            $rule=1;
                            //分配普通用户角色
                            $user->attachRole(4);

                            DB::commit();
                        }
                        else
                        {   
                            $rule=0;
                            DB::rollBack();
                        } 
                    }  
                }
                catch (\Exception $e) 
                { 
                    //接收异常处理并回滚
                    $rule=0; 
                    DB::rollBack(); 
                }
            }

            if($rule == 1)
            {
                $msg_array['data']['is_reload']=0;
                $msg_array['data']['curl']="/user/login";
                $msg_array['info']=$success_msg;
                $json_message=json_message(1,$msg_array['data'],$msg_array['info']);
                return $json_message;
            }
            else
            {
                $msg_array['data']['is_reload']=0;
                $msg_array['data']['curl']="";
                $msg_array['info']=$errory_msg;
                $json_message=json_message(2,$msg_array['data'],$msg_array['info']);
                return $json_message;
            } 
                
        } 
        else 
        {
            $msg_array['data']['is_reload']=0;
            $msg_array['data']['curl']="";
            $msg_array['info']=trans('register.failure_code');
            $json_message=json_message(2,$msg_array['data'],$msg_array['info']);
            return $json_message;
        }
    }
    /******************************************
    ****@AuThor : rubbish.boy@163.com
    ****@Title  : 检测数据存在
    ****@param  : $request
    ****@return : Response
    *******************************************/
    public function exit_api(Request $request)
    {
        $fieldname=$request->get('fieldname');
		$fieldval=$request->get('fieldval');
        $type=$request->get('type');
        /*******************************************/
        //屏蔽数据
        $clear_username="admin,superadmin";
        $clear_email="admin@163.com";
        $clear_mobile="15067636212";
		switch($fieldname)
		{
			case 'username':
                                $checkinfo=check_string_sub($clear_username,$fieldval,2);
                                if($checkinfo==true)
                                {
                                    $msg_array['data']=1;
                                    $msg_array['message']=trans('register.failure_username');
                                }
                                else
                                {
                                    $username = DB::table('users')->where('username', $fieldval)->first();
                                    if($username)
                                    {
                                        $msg_array['data']=1;
                                        $msg_array['message']=trans('register.failure_existed_username');
                                    }
                                    else
                                    {
                                        $msg_array['data']=0;
                                        $msg_array['message']=$type==1?trans('register.success_username'):trans('register.failure_notexisted_username');
                                    }		
                                }
                                $json_message=json_message(1,$msg_array['data'],$msg_array['message']);
                    break;
			case 'email':
                                $checkinfo=check_string_sub($clear_email,$fieldval,2);
                                if($checkinfo==true)
                                {
                                    $msg_array['data']=1;
                                    $msg_array['message']=trans('register.failure_email');
                                }
                                else
                                {
                                    $user_email = DB::table('users')->where('email',$fieldval)->first();
                                    if($user_email)
                                    {
                                        $msg_array['data']=1;
                                        $msg_array['message']=trans('register.failure_existed_email');
                                    }
                                    else
                                    {
                                        $msg_array['data']=0;
                                        $msg_array['message']=$type==1?trans('register.success_email'):trans('register.failure_notexisted_email');
                                    }		
                                }
                                $json_message=json_message(1,$msg_array['data'],$msg_array['message']);
                    break;
            case 'mobile':
                                $checkinfo=check_string_sub($clear_mobile,$fieldval,2);
                                if($checkinfo==true)
                                {
                                    $msg_array['data']=1;
                                    $msg_array['message']=trans('register.failure_mobile');
                                }
                                else
                                {
                                    $user_mobile = DB::table('users')->where('mobile', $fieldval)->first();
                                    if($user_mobile)
                                    {
                                        $msg_array['data']=1;
                                        $msg_array['message']=trans('register.failure_existed_mobile');
                                    }
                                    else
                                    {
                                        $msg_array['data']=0;
                                        $msg_array['message']=$type==1?trans('register.success_mobile'):trans('register.failure_notexisted_mobile');
                                    }		
                                }
                                $json_message=json_message(1,$msg_array['data'],$msg_array['message']);
                    break;        
			default:
				$json_message=json_message();
				break;
		}
		return $json_message;
    }

}
