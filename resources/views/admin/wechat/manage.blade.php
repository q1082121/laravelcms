@extends('layouts.admin')
@section('content')
<!-- Main content 主要内容区-->
    <section class="content">

      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box-header with-border" style="margin:0 0 15px 0;background:#fff;">
                <i class="fa fa-wechat " style="color:green"></i>
                <h3 class="box-title">{{trans('admin.define_model_wechat_setting_api')}}</h3>
          </div>
          <div class="box box-solid">
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-chain"></i></span>
                  <div class="info-box-content">
                      <h5 style="margin-top:5px;margin-bottom:5px;font-size:18px;">{{$website['info']['name']}}</h5>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-chain"></i></span>
                  <div class="info-box-content">
                      <h4 style="margin-bottom:5px;">URL : {{asset('/')}}wechat/api/{{$website['info']['id']}}.html</h5>
                      <h4 style="margin-bottom:5px;">TOKEN : {{$website['info']['token']}}</h5>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
          </div>
        </div>
      </div>
      <!-- /.row (main row) -->
      <style>
      .c_black{color:black;}
      .c_black:hover{color:black;}
      </style>
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box-header with-border" style="margin:0 0 15px 0;background:#fff;">
                <i class="fa fa-connectdevelop" style="color:green"></i>
                <h3 class="box-title">{{trans('admin.define_model_wechat_base')}}</h3>
          </div>
          <div class="box box-solid">

            <a href="{{route('get.admin.wechat.subscribe')}}/{{$website['id']}}" class="c_black">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number ">{{trans('admin.website_navigation_subscribe_reply')}}</span>
                    <span class="info-box-text ">{{trans('admin.define_model_wechat_subscribe_tip')}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </a>

            <a href="{{route('get.admin.wechat.defaultreply')}}/{{$website['id']}}" class="c_black">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-delicious"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number ">{{trans('admin.website_navigation_default_reply')}}</span>
                    <span class="info-box-text ">{{trans('admin.define_model_wechat_default_tip')}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </a>

            <a href="{{route('get.admin.wechat.messagetpl')}}/{{$website['id']}}" class="c_black">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-commenting"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number ">{{trans('admin.website_navigation_messagetpl_reply')}}</span>
                    <span class="info-box-text ">{{trans('admin.define_model_wechat_messagetpl_tip')}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </a>

            <a href="{{route('get.admin.wechatreplytext.index')}}/{{$website['id']}}" class="c_black">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-instagram"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number ">{{trans('admin.website_navigation_text_reply')}}</span>
                    <span class="info-box-text ">{{trans('admin.define_model_wechat_text_tip')}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </a>

            <a href="{{route('get.admin.wechatreplyimagetext.index')}}/{{$website['id']}}" class="c_black">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-file-image-o"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number ">{{trans('admin.website_navigation_imagetext_reply')}}</span>
                    <span class="info-box-text ">{{trans('admin.define_model_wechat_imagetext_tip')}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </a>

            <a href="{{route('get.admin.classifywechat.index')}}/{{$website['id']}}" class="c_black">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-list"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number ">{{trans('admin.website_navigation_wechat_menu')}}</span>
                    <span class="info-box-text ">{{trans('admin.define_model_wechat_menu_tip')}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </a>

            <a href="{{route('get.admin.wechatuser.index')}}/{{$website['id']}}" class="c_black">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number ">{{trans('admin.website_navigation_wechat_user')}}</span>
                    <span class="info-box-text ">{{trans('admin.define_model_wechat_user_tip')}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </a>

          </div>
        </div>
      </div>
      <!-- /.row (main row) -->

      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box-header with-border" style="margin:0 0 15px 0;background:#fff;">
                <i class="fa fa-trophy " style="color:green"></i>
                <h3 class="box-title">{{trans('admin.define_model_wechat_active')}}</h3>
          </div>
          <div class="box box-solid">

              <a href="javascript:void(0);" class="c_black">
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-music"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-number "></span>
                      <span class="info-box-text "></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
              </a>

          </div>
        </div>
      </div>
      <!-- /.row (main row) -->


    </section>
<!-- /.content -->

@endsection