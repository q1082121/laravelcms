@extends('layouts.app')
@section('content')
<div class="containor" style="position:relative;margin-top:-5vw;z-index:10;">
<div class="am-g am-g-collapse">
  <div class="am-u-sm-3">
    <!--panel start -->
    <a href="javascript:void(0);">
    <div class="panel panel-success">
        <div class="panel-heading color-FF6600">名小吃</div>
        <div class="panel-body">
            <span class="color-FF6600 panel-icon" >
                <i class="am-icon-magic panel-i"></i>
            </span>
        </div>
    </div>
    </a>
    <!--panel end -->
  </div>
  <div class="am-u-sm-3">
    <!--panel start -->
    <a href="javascript:void(0);">
    <div class="panel panel-success">
        <div class="panel-heading color-5ac8fa">馋零食</div>
        <div class="panel-body">
            <span class="color-5ac8fa panel-icon" >
                <i class="am-icon-angellist panel-i"></i>
            </span>
        </div>
    </div>
    </a>
    <!--panel end -->
  </div>
  <div class="am-u-sm-3">
    <!--panel start -->
    <a href="javascript:void(0);">
    <div class="panel panel-success">
        <div class="panel-heading color-FF6767">暗黑系</div>
        <div class="panel-body">
            <span class="color-FF6767 panel-icon" >
                <i class="am-icon-thumbs-up panel-i"></i>
            </span>
        </div>
    </div>
    </a>
    <!--panel end -->
  </div>
  <div class="am-u-sm-3">
    <!--panel start -->
    <a href="javascript:void(0);">
    <div class="panel panel-success">
        <div class="panel-heading color-58eaa1">最贪吃</div>
        <div class="panel-body">
            <span class="color-58eaa1 panel-icon" >
                <i class="am-icon-heart panel-i"></i>
            </span>
        </div>
    </div>
    </a>
    <!--panel end -->
  </div>
</div>
</div>

<script src="{{asset('/module')}}/socket.io-client-1.3.7/socket.io.js"></script>
<script>
$(document).ready(function () {
    var uid=1;
    // 连接服务端
    var socket = io('http://'+document.domain+':2120');
    // 连接后登录
    socket.on('connect', function(){
        socket.emit('login', uid);
    });
    // 后端推送来消息时
    socket.on('new_msg', function(msg){
            $('#content').html('收到消息：'+msg);
            $('.notification.sticky').notify();
    });
    // 后端推送来在线数据时
    socket.on('update_online_count', function(online_stat){
        $('#online_box').html(online_stat);
    });
});
</script>

@endsection
