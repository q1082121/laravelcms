@extends('layouts.admin')
@section('content')
<!-- Main content 主要内容区-->
    <section class="content" >
        <!-- general form elements -->
        <div class="box box-primary" id="app-content">
          <div class="box-header with-border">
            <h3 class="box-title">{{$website['cursitename']}}</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" id="frm-box" class="form-horizontal" method="POST">
            <input type="hidden" name="_token" v-model="saveModel._token"  value="<?php echo csrf_token(); ?>">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label" >{{trans('admin.website_setting_systitle')}}：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="systitle" v-model="saveModel.systitle" value="@{{ info.systitle }}"  placeholder="例如：LaravelCms内容管理系统" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" >{{trans('admin.website_setting_syskeyword')}}：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="syskeyword" v-model="saveModel.syskeyword" value="@{{ info.syskeyword }}"  placeholder="例如：LaravelCms" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" >{{trans('admin.website_setting_sysdescription')}}：</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="3" name="sysdescription" v-model="saveModel.sysdescription" placeholder="例如：LaravelCms内容管理系统">@{{ info.sysdescription }}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" >{{trans('admin.website_setting_sysicp')}}：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="sysicp" v-model="saveModel.sysicp" value="@{{ info.sysicp }}"  placeholder="例如：浙ICP备15022520号-1" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('admin.website_setting_sysmaster')}}：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="sysmaster" v-model="saveModel.sysmaster" value="@{{ info.sysmaster }}"  placeholder="例如：管理员" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('admin.website_setting_sysemail')}}：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="sysemail" v-model="saveModel.sysemail" value="@{{ info.sysemail }}"  placeholder="例如：admin@admin.com" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('admin.website_setting_sysmobile')}}：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="sysmobile" v-model="saveModel.sysmobile" value="@{{ info.sysmobile }}"  placeholder="例如：15011112222" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('admin.website_setting_sysfax')}}：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="sysfax" v-model="saveModel.sysfax" value="@{{ info.sysfax }}"  placeholder="例如：15011112222" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('admin.website_setting_sysqq')}}：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="sysqq" v-model="saveModel.sysqq" value="@{{ info.sysqq }}"  placeholder="例如：471416739" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('admin.website_setting_syswechat')}}：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="syswechat" v-model="saveModel.syswechat" value="@{{ info.syswechat }}"  placeholder="例如：XBDtommy" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('admin.website_setting_syscompany')}}：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="syscompany" v-model="saveModel.syscompany" value="@{{ info.syscompany }}"  placeholder="例如：LaravelCms有限公司" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('admin.website_setting_sysaddress')}}：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="sysaddress" v-model="saveModel.sysaddress" value="@{{ info.sysaddress }}"  placeholder="例如：浙江省台州市温岭市XX街道XX村XX号" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('admin.website_setting_syscoordinate_h')}}：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="syscoordinate_h" v-model="saveModel.syscoordinate_h" value="@{{ info.syscoordinate_h }}"  placeholder="例如北京：39.915053" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">{{trans('admin.website_setting_syscoordinate_w')}}：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="syscoordinate_w" v-model="saveModel.syscoordinate_w" value="@{{ info.syscoordinate_w }}"  placeholder="例如北京：116.403951" >
                </div>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <center><button @click="saveaction" type="button" class="btn btn-primary">{{trans('admin.website_save')}}</button> <button @click="getbackaction" type="button" class="btn btn-primary">{{trans('admin.website_getback')}}</button></center>
            </div>
          </form>
        </div>
        <!-- /.box -->
    </section>
    <script type="text/javascript">
      Vue.http.options.emulateHTTP = true;
      Vue.http.options.emulateJSON = true;
      new Vue({
          el: '#app-content',
          data: {
              apiUrl: '/admin/setting',
              info: {
                systitle:         '{{$website["info"]["systitle"]}}' ,
                syskeyword:       '{{$website["info"]["syskeyword"]}}' ,
                sysdescription :  '{{$website["info"]["sysdescription"]}}' ,
                sysicp:           '{{$website["info"]["sysicp"]}}' ,
                sysmaster:        '{{$website["info"]["sysmaster"]}}' ,
                sysemail:         '{{$website["info"]["sysemail"]}}' ,
                sysmobile:        '{{$website["info"]["sysmobile"]}}' ,
                sysfax:           '{{$website["info"]["sysfax"]}}' ,
                sysqq:            '{{$website["info"]["sysqq"]}}' ,
                syswechat:        '{{$website["info"]["syswechat"]}}' ,
                syscompany:       '{{$website["info"]["syscompany"]}}' ,
                sysaddress:       '{{$website["info"]["sysaddress"]}}' ,
                syscoordinate_h:  '{{$website["info"]["syscoordinate_h"]}}' ,
                syscoordinate_w:  '{{$website["info"]["syscoordinate_w"]}}' ,
              },
              saveModel:{
                _token:'',
                action_type: 'save' ,
                systitle: '' ,
                syskeyword: '' ,
                sysdescription : '' ,
                sysicp: '' ,
                sysmaster: '' ,
                sysemail: '' ,
                sysmobile: '' ,
                sysfax:'',
                sysqq: '' ,
                syswechat: '' ,
                syscompany: '' ,
                sysaddress: '' ,
                syscoordinate_h: '' ,
                syscoordinate_w: '' ,
              }
          },
          methods: {
            saveaction: function () {
                //alert('ok');
                this.$http.post(this.apiUrl, this.saveModel,{
                  before:function(request)
                  {
                    loadi=layer.load("检测中...");
                  }
                })
                .then((response) => 
                  {
                    //响应成功
                    layer.close(loadi);
                    getdata=response.body;
                    getdata=JSON.parse(getdata);
                    if(getdata.success==1)
                    {
                        var msg_data=getdata.data;
                        var info=msg_data.resource;
                        var msg=getdata.info;
                        this.$set('info', info);
                        layermsg_success(msg);
                    }
                    else
                    {
                        var msg=getdata.info;
                        layermsg_error(msg);
                    }
                  },(response) => 
                  {
                    //响应错误
                    var msg="{{trans('admin.website_outtime')}}";
                    layermsg_error(msg);
                  })
                  
                  .catch(function(response) {
                    //异常抛出
                    var msg="{{trans('admin.website_outtime_error')}}";
                    layermsg_error(msg);
                  })
            }, 
            getbackaction:function () {
              history.go(-1);
            }
          }
      })
    </script>
<!-- /.content -->
@endsection