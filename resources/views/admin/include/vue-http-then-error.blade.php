(response) => 
{
  /*响应错误*/
  layer.close(loadi);
  var msg="{{trans('admin.message_outtime')}}";
  layermsg_error(msg);
}