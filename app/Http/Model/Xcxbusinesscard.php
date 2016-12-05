<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :名片盒子
*******************************************/
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Xcxbusinesscard extends Model
{
    //
    /**
     * 在数组中隐藏的属性
     *
     * @var array
     */
    protected $hidden = ['xcxuser_id'];
    
	public function getCreatedAtAttribute($date)
    {

        if (Carbon::now() < Carbon::parse($date)->addDays(8)) 
        {
            return Carbon::parse($date)->diffForHumans();
        }
        else
        {
            return Carbon::parse($date)->format('m-d');
        }   
    }
    
    public function getUpdatedAtAttribute($date)
    {

        if (Carbon::now() < Carbon::parse($date)->addDays(8)) 
        {
            return Carbon::parse($date)->diffForHumans();
        }
        else
        {
            return Carbon::parse($date)->format('m-d');
        }   
    }
}
