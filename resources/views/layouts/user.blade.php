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
    <link rel="stylesheet" href="{{asset('/module/amazeui_admin/assets/css/amazeui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/module/amazeui_admin/assets/css/app.css')}}">
    <link rel="stylesheet" href="{{ elixir('css/user.css') }}">
    <script src="{{asset('/module/jquery/dist/jquery.min.js')}}"></script>
	<!--layer-->
	<script src="{{asset('/module/layer/layer.js')}}"></script>
    <!--common-->
    <script src="{{ elixir('js/user.js') }}"></script>
</head>

<body>
    <div class="am-g tpl-g">
        <script src="{{asset('/module/amazeui_admin/assets/js/theme.js')}}"></script>
        @include('user.header')
        <!-- 风格切换 -->
        <div class="tpl-skiner">
            <div class="tpl-skiner-toggle am-icon-cog">
            </div>
            <div class="tpl-skiner-content">
                <div class="tpl-skiner-content-title">
                    选择主题
                </div>
                <div class="tpl-skiner-content-bar">
                    <span class="skiner-color skiner-white" data-color="theme-white"></span>
                    <span class="skiner-color skiner-black" data-color="theme-black"></span>
                </div>
            </div>
        </div>
        @include('user.nav')
        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            @include('user.site')
            <!--模板主内容区 -->
                @yield('content')
            <!--/.模板主内容区 -->
        </div>
    </div>
	<script src="{{asset('/module/amazeui_admin/assets/js/amazeui.min.js')}}"></script>
    <script src="{{asset('/module/amazeui_admin/assets/js/app.js')}}"></script>
</body>
</html>