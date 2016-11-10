<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :用户
*******************************************/
namespace App\Http\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;
class User extends Authenticatable//\Eloquent 
{
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	/******************************************
	****@AuThor : rubbish@163.com
	****@Title  : 在 User 模型中增加一对一关系的函数
	*******************************************/
	public function hasOneUserinfo()
    {
        return $this->hasOne('App\Http\Model\Userinfo', 'user_id', 'id');
    }
}
