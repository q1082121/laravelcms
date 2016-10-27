<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$website['root']['systitle']}}</title>
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
    <link rel="stylesheet" href="{{asset('/module/amazeui')}}/dist/css/amazeui.min.css">
    <link rel="stylesheet" href="{{asset('/module/amazeui')}}/dist/css/amazeui.flat.min.css">
    <link rel="stylesheet" href="{{asset('/css/home')}}/style.css">
    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="{{asset('/module/jquery')}}/dist/jquery.min.js"></script>
    <!--<![endif]-->
    <!--[if lte IE 8 ]>
    <script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
    <script src="{{asset('/module/amazeui')}}/dist/js/amazeui.ie8polyfill.min.js"></script>
    <![endif]-->
    <script src="{{asset('/module/amazeui')}}/dist/js/amazeui.min.js"></script>
    <!--在这里编写你的代码-->
    <!--vue-->
    <script src="{{asset('/module/vue')}}/dist/vue.min.js"></script>
    <!--vue-resource-->
    <script src="{{asset('/module/vue-resource')}}/dist/vue-resource.min.js"></script>
    <!--layer-->
    <script src="{{asset('/module/layer')}}/layer.js"></script>
    <!--common-->
    <script src="{{asset('/js')}}/common.js"></script>
    <script src="{{asset('/js')}}/nav.js"></script>
    <script src="{{asset('/module/jquery-mkinfinite')}}/src/jquery.mkinfinite.js"></script> 
</head>
<body>
<div class="containor">
  <div class="header_top">
  </div>
</div>
<div class="header_bg">
  <div class="containor">
    <ul class="venus-menu">
      <li class="active"><a href="/"><i class="am-icon-home"></i>美食街</a></li>
      <li><a href="#"><i class="am-icon-magic"></i>美食攻略</a></li>
      <li><a href="#"><i class="am-icon-thumbs-up"></i>周边小吃</a></li>
      <li><a href="#"><i class="am-icon-bomb"></i>黑暗料理</a></li>
      <li><a href="#"><i class="am-icon-user"></i>美食猎人</a></li>
    </ul>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.header_bg').mkinfinite({
      maxZoom:       1.4,
      animationTime: 8000,
      imagesRatio:   (1920 / 700),
      isFixedBG:     true,
      zoomIn:        true,
      imagesList:    new Array(
        '/images/home/banner1.jpg',
        '/images/home/banner2.jpg',
        '/images/home/banner3.jpg',
        '/images/home/banner4.jpg',
        '/images/home/banner5.jpg'
      )
    });
  });
</script>
@yield('content')

<footer class="containor footer">
  <p>美食街<br/>
    <small>© Copyright 2016  站长：rubbish.boy@163.com </small>
  </p>
</footer>

</body>
</html>
