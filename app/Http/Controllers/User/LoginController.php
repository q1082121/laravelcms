<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :用户登录
*******************************************/
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
//引用对应的控制器
use App\Http\Controllers\Controller;

//引用对应的命名空间
use Validator;
use Session;
use Cache;
//使用数据库操作DB
use DB;
//引入验证控制
use Auth;

class LoginController extends Controller
{
	/******************************************
    ****@AuThor : rubbish.boy@163.com
    ****@Title  : 登录页面
    ****@param  : 
    ****@return : Response
    *******************************************/
     public function login(Request $request)
    {
    	$website['title']=trans('login.name');
        $website['login_name']=trans('login.name');
        $website['website_center_tip']=trans('admin.website_center_tip');
    	$website['copyrights']=trans('admin.website_name').trans('admin.website_rightinfo');
        $website['type']=$request->route('type')?$request->route('type'):4;
        $root=Cache::store('file')->get('root');
		$root['systitle']=@$root['systitle']?@$root['systitle']:"LaravelCms";
		$root['syskeywords']=@$root['syskeywords']?@$root['syskeywords']:"";
		$root['sysdescription']=@$root['sysdescription']?@$root['sysdescription']:"";
        $website['root']=$root;
        return view('user/login')->with('website',$website);
    }
    /******************************************
    ****@AuThor : rubbish.boy@163.com
    ****@Title  : 登录验证
    ****@param  : 
    ****@return : Response
    *******************************************/
    public function login_action(Request $request)
    {
        $code = $request->get('code');
        if (Session::get('login_captcha') == $code) 
        {
            $rule=0;
            $guard="admin";
            $success_msg=trans('login.success');
            $errory_msg=trans('login.failure');

            switch ($request->get('type')) 
            {
                case 1:
                    $user = DB::table('users')->where('email', $request->get('email'))->first();
                    if(empty($user))
                    {
                        $rule=11;
                        $errory_msg=trans('login.failure_existed_email');
                    }
                    break;
                case 2:
                    $user = DB::table('users')->where('username', $request->get('username'))->first();
                    if(empty($user))
                    {
                        $rule=12;
                        $errory_msg=trans('login.failure_existed_username');
                    }
                    break;
                case 3:
                    $user = DB::table('users')->where('mobile', $request->get('mobile'))->first();
                    if(empty($user))
                    {
                        $rule=13;
                        $errory_msg=trans('login.failure_existed_mobile');
                    }
                    break; 
                case 4:
                    $account=$request->get('account');
                    if(empty($account))
                    {
                        $rule=14;
                        $errory_msg=trans('login.failure_account');
                    }
                    break;        
                default:
                        
                    break;
            }
            if($rule<10)
            {
                switch ($request->get('type')) 
                {
                    case 1:
                        // 尝试登录
                        if (Auth::guard($guard)->attempt(['email' => $request->get('email'), 'password' => $request->get('userpwd') ,'is_lock' => 0 ])) 
                        {
                            // 认证通过...
                            $rule=1;
                            //return redirect()->intended('/admin');
                        }
                        break;
                    case 2:
                        // 尝试登录
                        if (Auth::guard($guard)->attempt(['username' => $request->get('username'), 'password' => $request->get('userpwd') ,'is_lock' => 0 ])) 
                        {
                            // 认证通过...
                            $rule=1;
                            //return redirect()->intended('/admin');
                        }
                        break;
                    case 3:
                        // 尝试登录
                        if (Auth::guard($guard)->attempt(['mobile' => $request->get('mobile'), 'password' => $request->get('userpwd') ,'is_lock' => 0  ])) 
                        {
                            // 认证通过...
                            $rule=1;
                            //return redirect()->intended('/admin');
                        }
                    case 4:
                        // 尝试登录
                        if (Auth::guard($guard)->attempt(['username' => $request->get('account'), 'password' => $request->get('userpwd') ,'is_lock' => 0  ])) 
                        {
                            // 认证通过...
                            $rule=1;
                            //return redirect()->intended('/admin');
                        }
                        else if(Auth::guard($guard)->attempt(['email' => $request->get('account'), 'password' => $request->get('userpwd') ,'is_lock' => 0  ]))
                        {
                            // 认证通过...
                            $rule=1;
                            //return redirect()->intended('/admin');
                        }
                        else if(Auth::guard($guard)->attempt(['mobile' => $request->get('account'), 'password' => $request->get('userpwd') ,'is_lock' => 0  ]))
                        {
                            // 认证通过...
                            $rule=1;
                            //return redirect()->intended('/admin');
                        }     
                        break;    
                    default:
                            
                        break;
                }

            }

            if($rule == 1)
            {

                $user =Auth::guard($guard)->user();
                $roleids=object_array(DB::table('role_user')->where('user_id',$user->id)->pluck('role_id'));
                if(@$roleids)
                {
                    $roleinfo=object_array(DB::table('roles')->whereIn('id',@$roleids)->orderBy('type', 'asc')->orderBy('level', 'desc')->first());
                }

                action_cache($user->id,'userinfo','update');

                /*******************
                 +记录日志 【      
                ********************/
                // 含有带花括号占位符的记录信息。
                $messagetpl = trans('user.login_action_info');
                // 带有替换信息的上下文数组，键名为占位符名称，键值为替换值。
                $context = interpolate($messagetpl, array('username' => $user->username));

                $log_data['type']=1;
                $log_data['user_id']=$user->id;
                $log_data['name']=$user->username;
                $log_data['info']=$context;
                $log_data['ip']=$request->getClientIp();
                in_log($log_data);
                /*******************
                 +          】      
                ********************/

                /*******************
                +每日登录获取经验值 【      
                ********************/
                $login_condition['type']=1;
                $login_condition['user_id']=$user->id;
                $startTime = date('Y-m-d'.' 00:00:00',time());
                $endTime   = date('Y-m-d'.' 23:59:59',time());
                $is_get_today_experience=object_array(DB::table('experiences')->where($login_condition)->whereBetween('created_at', [$startTime, $endTime])->count());
                if($is_get_today_experience==0)
                {
                    $experience=@$roleinfo['login_get_experience']?@$roleinfo['login_get_experience']:2;
                    $experiencetpl = trans('user.experience_action_info');
                    // 带有替换信息的上下文数组，键名为占位符名称，键值为替换值。
                    $experience_context = interpolate($experiencetpl, array('username' => $user->username,'experience'=>$experience));

                    $params_experience['type']=1;
                    $params_experience['val']=$experience;
                    $params_experience['info']=$experience_context;
                    $params_experience['user_id']=$user->id;
                    $params_experience['tablename']="";
		            $params_experience['keyid']=0;
                   
                    action_experience($params_experience,$roleinfo);

                }
                /*******************
                    +          】      
                ********************/
                

                switch(@$roleinfo['type'])
                {
                    case 1:
                            $linkurl=route('get.admin');
                    break;
                    case 2:
                            $linkurl=route('get.admin');
                    break;
                    case 3:
                            $linkurl=route('get.admin');
                    break;
                    case 4:
                            $linkurl='/user/';
                    break;
                    
                    default:
                            $linkurl='/user/';
                    break;
                }

                $msg_array['data']['is_reload']=0;
                $msg_array['data']['curl']=$linkurl;
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
            $msg_array['info']=trans('login.failure_code');
            $json_message=json_message(2,$msg_array['data'],$msg_array['info']);
            return $json_message;
        }
    }
    /******************************************
    ****@AuThor : rubbish.boy@163.com
    ****@Title  : 退出登录
    ****@param  : 
    ****@return : Response
    *******************************************/
     public function logout()
    {
       $guard="admin";
       Auth::guard($guard)->logout();
       return redirect(route('get.user.login'));
    }

}
