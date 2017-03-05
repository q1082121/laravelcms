.catch(function(response) {
  /*异常抛出*/
  layer.close(loadi);
  var msg="{{trans('admin.message_error')}}";
  layermsg_error(msg);
})