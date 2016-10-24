@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('/module')}}/socket.io-client-1.3.7/socket.io.js"></script>
<script>
// 如果服务端不在本机，请把127.0.0.1改成服务端ip
var socket = io('http://127.0.0.1:2120');
// 当连接服务端成功时触发connect默认事件
socket.on('connect', function(){
    console.log('connect success');
});
</script>

@endsection
