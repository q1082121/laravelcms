@extends('layouts.admin')
@section('content')
<!-- Main content 主要内容区-->
    <section class="content">

      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box-header with-border" style="margin:0 0 15px 0;background:#fff;">
                <i class="fa fa-wechat " style="color:green"></i>
                <h3 class="box-title">{{trans('admin.website_wechat_setting_api')}}</h3>
          </div>
          <div class="box box-solid">
              <div class="col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-chain"></i></span>
                  <div class="info-box-content">
                      <h5 style="margin-top:5px;margin-bottom:5px;font-size:18px;">公众号名称 : {{$website['info']['name']}}</h5>
                      <h5 style="margin-top:5px;margin-bottom:5px;">TOKEN : {{$website['info']['token']}}</h5>
                      <h5 style="margin-top:5px;margin-bottom:5px;">URL : {{asset('/')}}wechat/api/{{$website['info']['gid']}}.html</h5>
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
                <h3 class="box-title">{{trans('admin.website_wechat_model_base')}}</h3>
          </div>
          <div class="box box-solid">

            <a href="javascript:void(0);" class="c_black">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number ">{{trans('admin.website_wechat_model_base_subscribe_reply')}}</span>
                    <span class="info-box-text ">{{trans('admin.website_wechat_model_base_subscribe_tip')}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </a>

            <a href="javascript:void(0);" class="c_black">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-delicious"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number ">{{trans('admin.website_wechat_model_base_default_reply')}}</span>
                    <span class="info-box-text ">{{trans('admin.website_wechat_model_base_default_tip')}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </a>

            <a href="javascript:void(0);" class="c_black">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-instagram"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number ">{{trans('admin.website_wechat_model_base_text')}}</span>
                    <span class="info-box-text ">{{trans('admin.website_wechat_model_base_text_tip')}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </a>

            <a href="javascript:void(0);" class="c_black">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-file-image-o"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number ">{{trans('admin.website_wechat_model_base_imagetext')}}</span>
                    <span class="info-box-text ">{{trans('admin.website_wechat_model_base_imagetext_tip')}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </a>

            <a href="javascript:void(0);" class="c_black">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-list"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number ">{{trans('admin.website_wechat_model_base_menu')}}</span>
                    <span class="info-box-text ">{{trans('admin.website_wechat_model_base_menu_tip')}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            </a>

            <a href="javascript:void(0);" class="c_black">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-number ">{{trans('admin.website_wechat_model_base_user')}}</span>
                    <span class="info-box-text ">{{trans('admin.website_wechat_model_base_user_tip')}}</span>
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
                <h3 class="box-title">{{trans('admin.website_wechat_model_active')}}</h3>
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