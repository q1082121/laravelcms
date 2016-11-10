@extends('layouts.admin')
@section('content')
<script type="text/javascript">
 window.onload = function() {
  var show = document.getElementById("show");
  setInterval(function() 
  {
   var time = new Date();
   // 程序计时的月从0开始取值后+1
   var m = time.getMonth() + 1;
   var d = time.getDate();
   var h = time.getHours();
   var mt= time.getMinutes();
   var ms = time.getSeconds();
   if(m<10)
   {m='0'+m;}
   if(d<10)
   {d='0'+d;}
   if(h<10)
   {h='0'+h;}
   if(mt<10)
   {mt='0'+mt;}
   if(ms<10)
   {ms='0'+ms;}
   var t = time.getFullYear() + "-" + m + "-" + d + " " + h + ":" + mt + ":" + ms;
   show.innerHTML = t;
  }, 1000);
 };
</script>
<!--common-->
<!-- Main content 主要内容区-->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$website['count_navigation']}}</h3>
              <p>{{trans('admin.website_navigation_navigation')}}</p>
            </div>
            <div class="icon">
              <i class="fa fa-navicon"></i>
            </div>
            <a href="/admin/navigation" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$website['count_role']}}</h3>
              <p>{{trans('admin.website_navigation_role')}}</p>
            </div>
            <div class="icon">
              <i class="fa fa-gavel"></i>
            </div>
            <a href="/admin/role" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$website['count_permission']}}</h3>
              <p>{{trans('admin.website_navigation_permission')}}</p>
            </div>
            <div class="icon">
              <i class="fa fa-eye"></i>
            </div>
            <a href="/admin/permission" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$website['count_classifyproduct']}}</h3>
              <p>{{trans('admin.website_navigation_classifyproduct')}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-cube"></i>
            </div>
            <a href="/admin/classifyproduct" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$website['count_product']}}</h3>
              <p>{{trans('admin.website_navigation_product')}}</p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="/admin/product" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$website['count_classifylink']}}</h3>
              <p>{{trans('admin.website_navigation_classifylink')}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-leaf"></i>
            </div>
            <a href="/admin/classifylink" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
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
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$website['count_log']}}</h3>
              <p>{{trans('admin.website_navigation_three')}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-calendar"></i>
            </div>
            <a href="/admin/log" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>{{$website['count_letter_to']}}</h3>
              <p>{{trans('admin.website_letter_received')}}</p>
            </div>
            <div class="icon">
              <i class="fa fa-envelope-o"></i>
            </div>
            <a href="/admin/letter" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>{{$website['count_letter_from']}}</h3>
              <p>{{trans('admin.website_letter_send')}}</p>
            </div>
            <div class="icon">
              <i class="fa fa-envelope-o"></i>
            </div>
            <a href="/admin/letter/send" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>{{$website['count_question']}}</h3>
              <p>{{trans('admin.website_navigation_question_management')}}</p>
            </div>
            <div class="icon">
              <i class="fa fa-check-square-o"></i>
            </div>
            <a href="javascript:void(0);" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>{{$website['count_questionoption']}}</h3>
              <p>{{trans('admin.website_navigation_question_option')}}</p>
            </div>
            <div class="icon">
              <i class="fa fa-circle-o"></i>
            </div>
            <a href="javascript:void(0);" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
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
        <div class="col-md-12">
          <div class="box box-solid">
              <div class="box-header with-border" style="margin:0 0 15px 0;">
                <i class="fa fa-server"></i>
                <h3 class="box-title">{{trans('admin.website_navigation_serverinfo')}} ： {{$website['serverinfo']['server_soft']}}</h3>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_systime')}}</span>
                    <span class="info-box-number" id="show">
                    
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_server_host')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['server_host']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_server_port')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['server_port']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_server_serverip')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['serverip']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_client_ip')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['client_ip']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_phpver')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['phpver']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_phpos')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['phpos']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_phpsafe')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['phpsafe']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_xcachesp')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['xcachesp']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_cookiesp')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['cookiesp']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_sessionsp')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['sessionsp']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_curlsp')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['curlsp']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_gdsp')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['gdsp']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_maxpostsize')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['maxpostsize']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_maxupsize')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['maxupsize']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-tag"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">{{trans('admin.website_serverinfo_maxexectime')}}</span>
                    <span class="info-box-number">{{$website['serverinfo']['maxexectime']}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

          </div>
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>
<!-- /.content -->

@endsection