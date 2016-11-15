<!DOCTYPE html>
<html>	
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $website['title'] }}-{{trans('admin.website_name')}}-{{trans('admin.website_type')}}</title>
    <meta name="description" content="{{$website['root']['sysdescription']}}">
    <meta name="keywords" content="{{$website['root']['syskeywords']}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon"  href="/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="{{ $website['title'] }}" />
	<script src="{{asset('/module/jquery')}}/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('/module/amazeui_admin')}}/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="{{asset('/module/amazeui_admin')}}/assets/css/admin.css">
    <link rel="stylesheet" href="{{asset('/module/amazeui_admin')}}/assets/css/app.css">
    <script src="{{asset('/module/amazeui_admin')}}/assets/js/echarts.min.js"></script>
	<!--layer-->
	<script src="{{asset('/module/layer')}}/layer.js"></script>
	<!--vue-->
	<script src="{{asset('/module/vue')}}/dist/vue.min.js"></script>
	<!--common-->
	<script src="{{asset('/js')}}/common.js"></script>
</head>

<body>
	@include('user.header')
	<div class="tpl-page-container tpl-page-header-fixed">
        <div class="tpl-left-nav tpl-left-nav-hover">
            <div class="tpl-left-nav-title">
                {{trans('user.user_navigation_center')}}
            </div>
			@include('user.nav')
        </div>

        <div class="tpl-content-wrapper">
            @include('user.site')
            <!--模板主内容区 -->
                @yield('content')
            <!--/.模板主内容区 --> 
        </div>
    </div>

	<script src="{{asset('/module/amazeui_admin')}}/assets/js/amazeui.min.js"></script>
    <script src="{{asset('/module/amazeui_admin')}}/assets/js/iscroll.js"></script>
    <script src="{{asset('/module/amazeui_admin')}}/assets/js/app.js"></script>
</body>
</html>