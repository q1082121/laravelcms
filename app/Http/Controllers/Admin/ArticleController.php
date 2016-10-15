<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :文章资讯
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//使用Class模型
use App\Http\Model\Article;
use DB;
//使用URL生成地址
use URL;
//使用自定义第三方类库:分类列表数据 
use App\Common\lib\Cates; 
class ArticleController extends PublicController
{
    //
}
