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
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/module/AdminLTE/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('/module/AdminLTE/dist/css/skins/_all-skins.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('/module/AdminLTE/plugins/iCheck/all.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('/module/AdminLTE/plugins/morris/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('/module/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('/module/AdminLTE/plugins/datepicker/datepicker3.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('/module/AdminLTE/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('/module/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <link rel="stylesheet" href="{{ elixir('css/admin.css') }}">

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

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ route('get.admin') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels 项目名称简称-->
      <span class="logo-mini"><b>{{trans('admin.website_sname')}}</b></span>
      <!-- logo for regular state and mobile devices 项目名称全称-->
      <span class="logo-lg"><b>{{trans('admin.website_name')}}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button 头部左侧缩放按钮-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">{{trans('admin.website_Toggle_navigation')}}</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less 用户相关信息提示-->
          <li class="dropdown messages-menu" id="message-content">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">{{$website['letters_count']}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">{{trans('admin.define_model_letter_newtip')}}</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <!-- start message -->
                  <li v-for="item in letters_list" >
                    <a href="javascript:void(0);">
                      <div class="pull-left">
                        <img src="{{$website['website_userinfo']['avatar']}}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        @{{item.email_from}}
                      </h4>
                      <p>@{{item.title}}</p>
                      <p>@{{item.created_at}}</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="{{ route('get.admin.letter') }}">{{trans('admin.define_model_allletter_tip')}}</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less-->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">{{trans('admin.define_model_msg_tip')}}</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less  用户简介信息-->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{$website['website_userinfo']['avatar']}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{$website['website_user']['username']}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{$website['website_userinfo']['avatar']}}" class="img-circle" alt="User Image">

                <p>
                  {{$website['website_user']['username']}} - {{$website['website_userinfo']['nick']}}
                  <small>{{trans('admin.define_model_user_regdate')}} : {{$website['website_user']['created_at']->format('Y-m-d')}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">{{trans('admin.define_model_user_followers')}}</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">{{trans('admin.define_model_user_fans')}}</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">{{trans('admin.define_model_user_friends')}}</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('get.admin.userinfo') }}" class="btn btn-default btn-flat">{{trans('admin.define_model_user_profile')}}</a>
                </div>
                <div class="pull-right" >
                  <a href="{{ route('get.user.logout') }}" class="btn btn-default btn-flat">{{trans('admin.define_model_user_signout')}}</a>
                </div>
                <div class="pull-right" style="margin-right:6px">
                  <a href="{{ route('get.admin.edit_pwd') }}" class="btn btn-default btn-flat">{{trans('admin.define_model_user_editpwd')}}</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel 当前用户信息-->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{$website['website_userinfo']['avatar']}}" class="img-circle" alt="User Image" onclick="localcul('{{ route('get.admin.userinfo') }}') " >
        </div>
        <div class="pull-left info">
          <p>{{$website['website_user']['username']}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i>{{trans('admin.define_model_user_online')}}</a>
        </div>
      </div>
      <!-- search form 左侧搜索框-->
      <form action="#" method="get" class="sidebar-form" style="color:#fff;text-align:center;line-height:28px;" >
        <!--
        <div class="input-group" >
          
          <input type="text" name="q" class="form-control" placeholder="{{trans('admin.define_model_search_tip')}}">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
          </span> 
        </div>
        -->
        <p>{{$website['website_user']['email']}}</p>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less 左侧导航菜单区域-->
      @include('admin.nav')
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) 头部路径信息 -->
      <section class="content-header">
          <h1>
          {{$website['cursitename']}}
          <small>{{trans('admin.website_site')}}</small>
          </h1>
          <ol class="breadcrumb">
          <li><a href="{{ route('get.admin') }}"><i class="fa fa-dashboard"></i> {{trans('admin.website_navigation_one')}}</a></li>
          <li class="active">{{$website['cursitename']}}</li>
          </ol>
      </section>
      <!--模板主内容区 -->
          @yield('content')
      <!--/.模板主内容区 --> 
  </div>
  <!-- /.content-wrapper 脚部版权信息 -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>{{trans('admin.website_version_name')}}</b> {{trans('admin.website_version')}}
    </div>
    <strong>Copyright &copy; <a href="{{asset('/')}}">{{trans('admin.website_name')}}</a>.</strong> {{trans('admin.website_version_tip')}}.
  </footer>

  <!-- Control Sidebar 设置-->
  <aside class="control-sidebar control-sidebar-dark" id="app-setting">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href='#control-sidebar-theme-demo-options-tab' data-toggle='tab'><i class='fa fa-wrench'></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-theme-demo-options-tab">
        <h3 class="control-sidebar-heading">布局选项</h3>
        <div class='form-group'>
        <label class='control-sidebar-subheading'>
        <input type='checkbox' @click="setting_action('layout_fixed')" v-model="params_data.layout_fixed"  data-layout='fixed' class='pull-right'/>
        固定布局
        </label>
        <p>激活固定布局。 您不能同时使用固定和盒装布局</p>
        </div>

        <div class='form-group'>
        <label class='control-sidebar-subheading'>
        <input type='checkbox' @click="setting_action('layout_boxed')" v-model="params_data.layout_boxed" data-layout='layout-boxed' class='pull-right'/>
        盒装布局
        </label>
        <p>激活带框的布局</p>
        </div>

        <div class='form-group'>
        <label class='control-sidebar-subheading'>
        <input type='checkbox' @click="setting_action('layout_sidebar_collapse')" v-model="params_data.layout_sidebar_collapse" data-layout='sidebar-collapse' class='pull-right'/>
        切换侧栏
        </label>
        <p>切换左侧栏的状态（打开或折叠）</p>
        </div>

        <div class='form-group'>
        <label class='control-sidebar-subheading'>
        <input type='checkbox' @click="setting_action('layout_expandOnHover')" v-model="params_data.layout_expandOnHover" data-enable='expandOnHover' class='pull-right'/> 
        侧栏在悬停时展开
        </label>
        <p>让侧栏小部件在悬停时展开</p>
        </div>

        <div class='form-group'>
        <label class='control-sidebar-subheading'>
        <input type='checkbox' @click="setting_action('layout_control_sidebar_open')" v-model="params_data.layout_control_sidebar_open"  data-controlsidebar='control-sidebar-open' class='pull-right'/>
        切换右侧边栏幻灯片
        </label>
        <p>在幻灯片内容和推送内容效果之间切换</p>
        </div>

        <div class='form-group'>
        <label class='control-sidebar-subheading'>
        <input type='checkbox' @click="setting_action('layout_toggle')" v-model="params_data.layout_toggle" data-sidebarskin='toggle' class='pull-right'/>
        切换右侧边皮肤
        </label>
        <p>在右侧边栏的暗色和浅色皮肤之间切换</p>
        </div>
        <!-- /.control-sidebar-Options -->

        <h3 class="control-sidebar-heading">皮肤</h3>
        <ul class="list-unstyled clearfix">
          <li style="float:left; width: 33.33333%; padding: 5px;">
              <a @click="setting_action('skin_blue')" href="javascript:void(0);" data-skin="skin-blue" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                  <div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9;"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span>
                  </div>
                  <div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                  </div>
              </a>
              <p class="text-center no-margin">蓝色</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
              <a  @click="setting_action('skin_black')" href="javascript:void(0);" data-skin="skin-black" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                  <div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe;"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe;"></span>
                  </div>
                  <div><span style="display:block; width: 20%; float: left; height: 20px; background: #222;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                  </div>
              </a>
              <p class="text-center no-margin">白色</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
              <a @click="setting_action('skin_purple')" href="javascript:void(0);" data-skin="skin-purple" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                  <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span>
                  </div>
                  <div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                  </div>
              </a>
              <p class="text-center no-margin">紫色</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
              <a @click="setting_action('skin_green')" href="javascript:void(0);" data-skin="skin-green" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                  <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span>
                  </div>
                  <div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                  </div>
              </a>
              <p class="text-center no-margin">绿色</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
              <a @click="setting_action('skin_red')" href="javascript:void(0);" data-skin="skin-red" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                  <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span>
                  </div>
                  <div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                  </div>
              </a>
              <p class="text-center no-margin">红色</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
              <a @click="setting_action('skin_yellow')" href="javascript:void(0);" data-skin="skin-yellow" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                  <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span>
                  </div>
                  <div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                  </div>
              </a>
              <p class="text-center no-margin">黄色</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
              <a @click="setting_action('skin_blue_light')" href="javascript:void(0);" data-skin="skin-blue-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                  <div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9;"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span>
                  </div>
                  <div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                  </div>
              </a>
              <p class="text-center no-margin" style="font-size: 12px">蓝白</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
              <a @click="setting_action('skin_black_light')" href="javascript:void(0);" data-skin="skin-black-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                  <div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe;"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe;"></span>
                  </div>
                  <div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                  </div>
              </a>
              <p class="text-center no-margin" style="font-size: 12px">白白</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
              <a @click="setting_action('skin_purple_light')" href="javascript:void(0);" data-skin="skin-purple-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                  <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span>
                  </div>
                  <div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                  </div>
              </a>
              <p class="text-center no-margin" style="font-size: 12px">紫白</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
              <a @click="setting_action('skin_green_light')" href="javascript:void(0);" data-skin="skin-green-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                  <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span>
                  </div>
                  <div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                  </div>
              </a>
              <p class="text-center no-margin" style="font-size: 12px">绿白</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
              <a @click="setting_action('skin_red_light')" href="javascript:void(0);" data-skin="skin-red-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                  <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span>
                  </div>
                  <div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                  </div>
              </a>
              <p class="text-center no-margin" style="font-size: 12px">红白</p>
          </li>
          <li style="float:left; width: 33.33333%; padding: 5px;">
              <a @click="setting_action('skin_yellow_light')" href="javascript:void(0);" data-skin="skin-yellow-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">
                  <div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span>
                  </div>
                  <div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc;"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;"></span>
                  </div>
              </a>
              <p class="text-center no-margin" style="font-size: 12px;">黄白</p>
          </li>
      </ul>
      <!-- /.control-sidebar-Skins -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">统计信息选项卡内容</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">常规设置</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              报告面板用法
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              有关此常规设置选项的一些信息
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              允许邮件重定向
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              其他选项集可用
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              在帖子中公开作者姓名
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              允许用户在博客帖子中显示他的名字
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">聊天设置</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              显示为在线
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              关闭通知
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/module/AdminLTE/dist/js/jquery-ui/1.11.4/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('/module/AdminLTE/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts 
<script src="{{asset('/module/AdminLTE/dist/js/raphael/2.1.0/raphael-min.js')}}"></script>
<script src="{{asset('/module/AdminLTE/plugins/morris/morris.min.js')}}"></script>
-->
<!-- Sparkline -->
<script src="{{asset('/module/AdminLTE/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('/module/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('/module/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('/module/AdminLTE/plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('/module/AdminLTE/dist/js/moment/2.11.2/min/moment.min.js')}}"></script>
<script src="{{asset('/module/AdminLTE/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('/module/AdminLTE/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('/module/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('/module/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('/module/AdminLTE/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/module/AdminLTE/dist/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) 
<script src="{{asset('/module/AdminLTE/dist/js/pages/dashboard.js')}}"></script>
-->
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/module/AdminLTE/dist/js/demo.js')}}"></script>
<!-- icheck -->
<script src="{{asset('/module/AdminLTE/plugins/iCheck/icheck.min.js')}}"></script>

<script type="text/javascript">
  new Vue({
      el: '#app-setting',
      data: {
               apiurl_setting                  :'{{$website["apiurl_setting"]}}', 
               params_data:
               {
                  layout_fixed                :{{$website["setting"]["layout_fixed"]}},
                  layout_boxed                :{{$website["setting"]["layout_boxed"]}},
                  layout_sidebar_collapse     :{{$website["setting"]["layout_sidebar_collapse"]}},
                  layout_expandOnHover        :{{$website["setting"]["layout_expandOnHover"]}},
                  layout_control_sidebar_open :{{$website["setting"]["layout_control_sidebar_open"]}},
                  layout_toggle               :{{$website["setting"]["layout_toggle"]}},
                  skin_blue                   :{{$website["setting"]["skin_blue"]}},
                  skin_black                  :{{$website["setting"]["skin_black"]}},
                  skin_purple                 :{{$website["setting"]["skin_purple"]}},
                  skin_green                  :{{$website["setting"]["skin_green"]}},
                  skin_red                    :{{$website["setting"]["skin_red"]}},
                  skin_yellow                 :{{$website["setting"]["skin_yellow"]}},
                  skin_blue_light             :{{$website["setting"]["skin_blue_light"]}},
                  skin_black_light            :{{$website["setting"]["skin_black_light"]}},
                  skin_purple_light           :{{$website["setting"]["skin_purple_light"]}},
                  skin_green_light            :{{$website["setting"]["skin_green_light"]}},
                  skin_red_light              :{{$website["setting"]["skin_red_light"]}},
                  skin_yellow_light           :{{$website["setting"]["skin_yellow_light"]}},
                  layout_attributes           :'',
               }
            },
      created: function ()
      { 
          if(this.params_data.layout_fixed==1)
          {
             $("[data-layout='fixed']").trigger("readys");
          }
          if(this.params_data.layout_boxed==1)
          {
             $("[data-layout='layout-boxed']").trigger("readys");
          }
          if(this.params_data.layout_sidebar_collapse==1)
          {
             $("[data-layout='sidebar-collapse']").trigger("readys");
          }
          if(this.params_data.layout_expandOnHover==1)
          {
             $("[data-enable='expandOnHover']").trigger("readys");
          }
          if(this.params_data.layout_control_sidebar_open==1)
          {
             $("[data-controlsidebar='control-sidebar-open']").trigger("readys");
          }
          if(this.params_data.layout_toggle==1)
          {
             $("[data-sidebarskin='toggle']").trigger("readys");
          }


          if(this.params_data.skin_blue==1)
          {
             $("[data-skin='skin-blue']").trigger("readys");
          }
          if(this.params_data.skin_black==1)
          {
             $("[data-skin='skin-black']").trigger("readys");
          }
          if(this.params_data.skin_purple==1)
          {
             $("[data-skin='skin-purple']").trigger("readys");
          }
          if(this.params_data.skin_green==1)
          {
             $("[data-skin='skin-green']").trigger("readys");
          }
          if(this.params_data.skin_red==1)
          {
             $("[data-skin='skin-red']").trigger("readys");
          }
          if(this.params_data.skin_yellow==1)
          {
             $("[data-skin='skin-yellow']").trigger("readys");
          }

          if(this.params_data.skin_blue_light==1)
          {
             $("[data-skin='skin-blue-light']").trigger("readys");
          }
          if(this.params_data.skin_black_light==1)
          {
             $("[data-skin='skin-black-light']").trigger("readys");
          }
          if(this.params_data.skin_purple_light==1)
          {
             $("[data-skin='skin-purple-light']").trigger("readys");
          }
          if(this.params_data.skin_green_light==1)
          {
             $("[data-skin='skin-green-light']").trigger("readys");
          }
          if(this.params_data.skin_red_light==1)
          {
             $("[data-skin='skin-red-light']").trigger("readys");
          }
          if(this.params_data.skin_yellow_light==1)
          {
             $("[data-skin='skin-yellow-light']").trigger("readys");
          }

      }, 
      methods: 
      {
        //提交修改数据
        setting_action:function(data)
        {
          this.params_data.layout_attributes=data;
          this.$http.post(this.apiurl_setting,this.params_data,{
            before:function(request)
            {
              loadi=layer.load("...");
            },
          })
          .then((response) => 
          {
            this.return_info_action(response);

          },(response) => 
          {
            //响应错误
            layer.close(loadi);
            var msg="{{trans('admin.message_outtime')}}";
            layermsg_error(msg);
          })
          .catch(function(response) {
            //异常抛出
            layer.close(loadi);
            var msg="{{trans('admin.message_error')}}";
            layermsg_error(msg);
          })
        },
        //返回信息处理
        return_info_action:function(response)
        {
          layer.close(loadi);
          var statusinfo=response.data;
          if(statusinfo.status==1)
          {
              if(statusinfo.is_reload==1)
              {
                layermsg_success_reload(statusinfo.info);
              }
              else
              {
                if(statusinfo.curl)
                {
                  layermsg_s(statusinfo.info,statusinfo.curl);
                }
                else
                {
                  layermsg_success(statusinfo.info);
                  this.params_data=statusinfo.resource;
                }
              }
          }
          else
          {
              if(statusinfo.curl)
              {
                layermsg_e(statusinfo.info,statusinfo.curl);
              }
              else
              {

                layermsg_error(statusinfo.info);
              }
          }
        }

      }               
  });

  new Vue({
      el: '#message-content',
      data: {
               letters_list         :eval(htmlspecialchars_decode('{{$website["letters_list"]}}')), 
            },
             
  });
  </script>

</body>
</html>
