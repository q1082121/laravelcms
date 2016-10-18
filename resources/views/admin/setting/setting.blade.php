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
          <div class="box-body">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_setting_systitle')}}</span>
                  <input type="text" class="form-control" name="systitle" v-model="info.systitle" value="@{{ info.systitle }}"  placeholder="例如：LaravelCms内容管理系统" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_setting_syskeyword')}}</span>
                  <input type="text" class="form-control" name="syskeyword" v-model="info.syskeyword" value="@{{ info.syskeyword }}"  placeholder="例如：LaravelCms" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_setting_sysdescription')}}</span>
                  <textarea class="form-control" rows="3" name="sysdescription" v-model="info.sysdescription" placeholder="例如：LaravelCms内容管理系统">@{{ info.sysdescription }}</textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_setting_sysicp')}}</span>
                  <input type="text" class="form-control" name="sysicp" v-model="info.sysicp" value="@{{ info.sysicp }}"  placeholder="例如：浙ICP备15022520号-1" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_setting_sysmaster')}}</span>
                  <input type="text" class="form-control" name="sysmaster" v-model="info.sysmaster" value="@{{ info.sysmaster }}"  placeholder="例如：管理员" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_setting_sysemail')}}</span>
                  <input type="text" class="form-control" name="sysemail" v-model="info.sysemail" value="@{{ info.sysemail }}"  placeholder="例如：admin@admin.com" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_setting_sysmobile')}}</span>
                  <input type="text" class="form-control" name="sysmobile" v-model="info.sysmobile" value="@{{ info.sysmobile }}"  placeholder="例如：15011112222" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_setting_sysfax')}}</span>
                  <input type="text" class="form-control" name="sysfax" v-model="info.sysfax" value="@{{ info.sysfax }}"  placeholder="例如：15011112222" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_setting_sysqq')}}</span>
                  <input type="text" class="form-control" name="sysqq" v-model="info.sysqq" value="@{{ info.sysqq }}"  placeholder="例如：471416739" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_setting_syswechat')}}</span>
                  <input type="text" class="form-control" name="syswechat" v-model="info.syswechat" value="@{{ info.syswechat }}"  placeholder="例如：XBDtommy" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_setting_syscompany')}}</span>
                  <input type="text" class="form-control" name="syscompany" v-model="info.syscompany" value="@{{ info.syscompany }}"  placeholder="例如：LaravelCms有限公司" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_setting_sysaddress')}}</span>
                  <input type="text" class="form-control" name="sysaddress" v-model="info.sysaddress" value="@{{ info.sysaddress }}"  placeholder="例如：浙江省台州市温岭市XX街道XX村XX号" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_setting_syscoordinate_h')}}</span>
                  <input type="text" class="form-control" name="syscoordinate_h" v-model="info.syscoordinate_h" value="@{{ info.syscoordinate_h }}"  placeholder="例如北京：39.915053" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_setting_syscoordinate_w')}}</span>
                  <input type="text" class="form-control" name="syscoordinate_w" v-model="info.syscoordinate_w" value="@{{ info.syscoordinate_w }}"  placeholder="例如北京：116.403951" >
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-header with-border">
              <h3 class="box-title">{{trans('admin.website_setting_editor')}}</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">{{trans('admin.website_setting_editor_type')}}</span>
                    <select class="form-control" v-model="info.syseditor" >
                      <option v-for="item in editoroption" value="@{{ item.value }}">@{{ item.text }}</option>
                    </select>
                  </div>
              </div>
            </duv>
            <div class="box-footer">
              <center><button @click="saveaction" type="button" class="btn btn-primary">{{trans('admin.website_save')}}</button> <button @click="getbackaction" type="button" class="btn btn-primary">{{trans('admin.website_getback')}}</button></center>
            </div>
        
        
          </div>
        <!-- /.box -->
    </section>
    <script type="text/javascript">
      Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name=csrf-token]').getAttribute('content')
      Vue.http.options.emulateJSON = true;
      new Vue({
          el: '#app-content',
          data: {
            
              apiurl_cache:       '{{$website["apiurl_cache"]}}',
              editoroption        :eval(htmlspecialchars_decode('{{$website["editoroption"]}}')),
              info: {
                modelname:        '{{$website["modelname"]}}' ,
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
                syseditor:        '{{$website["info"]["syseditor"]}}' ,
              },
          },
          methods: {
            saveaction: function () {
                this.$http.post(this.apiurl_cache, this.info,{
                  before:function(request)
                  {
                    loadi=layer.load("检测中...");
                  }
                })
                .then((response) => 
                  {
                    //响应成功
                    layer.close(loadi);
                    var statusinfo=response.data;
                    if(statusinfo.status==1)
                    {
                        this.info=statusinfo.resource;
                        layermsg_success(statusinfo.info);
                    }
                    else
                    {
                        layermsg_error(statusinfo.info);
                    }
                  },(response) => 
                  {
                    //响应错误
                    layer.close(loadi);
                    var msg="{{trans('admin.website_outtime')}}";
                    layermsg_error(msg);
                  })
                  
                  .catch(function(response) {
                    //异常抛出
                    layer.close(loadi);
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