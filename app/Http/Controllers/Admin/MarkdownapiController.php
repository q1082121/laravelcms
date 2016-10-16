<?php
/******************************************
****AuThor:rubbish.boy@163.com
****Title :markdown 
*******************************************/
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
//使用URL生成地址
use URL;
use EndaEditor;
class MarkdownapiController extends PublicController
{
    /******************************************
    ****AuThor:rubbish.boy@163.com
    ****Title :上传方法
    *******************************************/
    public function upload()
    {
        $uploads_dir=public_path('uploads').'/Markdown/';
        if(!is_dir($uploads_dir)) 
        {
            mkdir($uploads_dir, 0777, true);
        }
        $common_dir="uploads/Markdown";
        $data = EndaEditor::uploadImgFile($common_dir);
        return json_encode($data);
    }
   
}
