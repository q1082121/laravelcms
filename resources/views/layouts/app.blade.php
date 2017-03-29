<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$website['title']}}</title>
    <meta name="keywords" content="{{$website['root']['syskeywords']}}">
    <meta name="description" content="{{$website['root']['sysdescription']}}">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content=""/>
    <link rel="shortcut icon" href="/favicon.ico" >
    <link rel="stylesheet" href="{{ elixir('css/home.css') }}">
    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="{{asset('/module/jquery/dist/jquery.min.js')}}"></script>
    <!--layer-->
    <script src="{{asset('/module/layer/layer.js')}}"></script>
    <!--common-->
    <script src="{{ elixir('js/home.js') }}"></script>
</head>
<body>
<div id="appContent">
@yield('content')
</div>
<footer class="footer">
  <p>美食街<br/>
    <small>© Copyright 2016  站长：rubbish.boy@163.com </small>
  </p>
</footer>
<!--main-->
<script src="{{ asset('/js/main.js') }}"></script>
</body>
</html>
