<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>{{$website['cursitename']}}-{{$website['website_seo_title']}}-{{trans('admin.website_type')}}</title>
  <meta name="keywords" content="{{$website['website_seo_keywords']}}" >
  <meta name="description" content="{{$website['website_seo_description']}}" >
  <link rel="shortcut icon" href="/favicon.ico" >
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" >
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('/module/AdminLTE/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/module/AdminLTE/dist/css/font-awesome/4.6.3/css/font-awesome.min.css')}}" >
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('/module/AdminLTE/dist/css/ionicons/2.0.1/css/ionicons.min.css')}}" >
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('/module/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/module/AdminLTE/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('/module/AdminLTE/dist/css/skins/_all-skins.min.css')}}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="{{asset('/module/AdminLTE/dist/js/html5shiv/3.7.3/dist/html5shiv.min.js')}}"></script>
  <script src="{{asset('/module/AdminLTE/dist/js/respond/1.4.2/dest/respond.min.js')}}"></script>
  <![endif]-->
  <!-- jQuery 2.2.3 -->
  <script src="{{asset('/module/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
  <!--layer-->
  <script src="{{asset('/module/layer/layer.js')}}"></script>
  <!--common-->
  <script src="{{ elixir('js/admin.js') }}"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left:0">
      <!--模板主内容区 -->
          @yield('content')
      <!--/.模板主内容区 --> 
  </div>
  <!-- /.content-wrapper 脚部版权信息 -->
  <footer class="main-footer" style="margin-left:0">
    <div class="pull-right hidden-xs">
      <b>{{trans('admin.website_version_name')}}</b> {{trans('admin.website_version')}}
    </div>
    <strong>Copyright &copy; <a href="{{asset('/')}}">{{trans('admin.website_name')}}</a>.</strong> {{trans('admin.website_version_tip')}}.
  </footer>
</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.6 -->
<script src="{{asset('/module/AdminLTE/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('/module/AdminLTE/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('/module/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('/module/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('/module/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('/module/AdminLTE/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/module/AdminLTE/dist/js/app.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/module/AdminLTE/dist/js/demo.js')}}"></script>

</body>
</html>
