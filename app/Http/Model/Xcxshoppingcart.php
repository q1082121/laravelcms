<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :小程序购物车
*******************************************/
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Xcxshoppingcart extends Model
{
  //
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
