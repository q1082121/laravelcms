@extends('layouts.admin')
@section('content')
<!-- Main content 主要内容区-->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$website['count_log']}}</h3>
              <p>{{trans('admin.website_navigation_three')}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-calendar-o"></i>
            </div>
            <a href="/admin/log" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$website['count_user']}}</h3>
              <p>{{trans('admin.website_navigation_five')}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="/admin/user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$website['count_classify']}}</h3>
              <p>{{trans('admin.website_navigation_classify')}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-th-large"></i>
            </div>
            <a href="/admin/classify" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$website['count_article']}}</h3>
              <p>{{trans('admin.website_navigation_six')}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-newspaper-o"></i>
            </div>
            <a href="/admin/article" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$website['count_picture']}}</h3>
              <p>{{trans('admin.website_navigation_seven')}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-image"></i>
            </div>
            <a href="/admin/picture" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$website['count_link']}}</h3>
              <p>{{trans('admin.website_navigation_eight')}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-leaf"></i>
            </div>
            <a href="/admin/link" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$website['count_wechat']}}</h3>
              <p>{{trans('admin.website_navigation_nine')}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-wechat"></i>
            </div>
            <a href="/admin/wechat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        
      </div>
      <!-- /.row (main row) -->

    </section>
<!-- /.content -->

@endsection