@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
  <!-- row -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box" id="app-content">
        <div class="box-header">
          <h3 class="box-title"> 【{{trans('admin.website_navigation_userinfo')}} 】 </h3>
        </div>
        <!-- /.box-header -->

          <link rel="stylesheet" type="text/css" href="{{asset('/module/DateTimePicker')}}/src/DateTimePicker.css" />
          <script type="text/javascript" src="{{asset('/module/DateTimePicker')}}/src/DateTimePicker.js"></script>
          <div id="dtBox"></div>
          <script type="text/javascript">
          
            $(document).ready(function()
            {
              $("#dtBox").DateTimePicker({
              
                dateFormat: "yyyy-MM-dd",
                timeFormat: "HH:mm",
                dateTimeFormat: "yyyy-MM-dd HH:mm:ss"
              
              });
            });
          
          </script>

          <div class="box-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">{{trans('admin.website_userinfo_name')}}</span>
                <input type="text" id="name" class="form-control" v-model="params_data.name" >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">{{trans('admin.website_userinfo_nick')}}</span>
                <input type="text" class="form-control" v-model="params_data.nick"   >
              </div>
            </div>
            <div class="form-group">
              <label >{{trans('admin.website_userinfo_sex')}}</label>
              <br>
              <input type="radio"  value="1" v-model="params_data.sex"> 男 
              <input type="radio"  value="2" v-model="params_data.sex"> 女 
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">{{trans('admin.website_userinfo_birthday')}}</span>
                <input type="text" class="form-control" v-model="params_data.birthday"  data-field="date" data-format="yyyy-MM-dd" readonly >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">{{trans('admin.website_userinfo_qq')}}</span>
                <input type="text" class="form-control" v-model="params_data.qq"   >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">{{trans('admin.website_userinfo_area_pid')}}</span>
                <select @change="get_area_action(params_data.area_pid,2)" v-model="params_data.area_pid" class="form-control" >
                  <option v-for="item in area_data_p" value="@{{ item.id }}">@{{ item.alias }}</option>
                </select>
              </div>
              <div class="input-group">
                <span class="input-group-addon">{{trans('admin.website_userinfo_area_cid')}}</span>
                <select @change="get_area_action(params_data.area_cid,3)" v-model="params_data.area_cid" class="form-control" >
                  <option v-for="item in area_data_c" value="@{{ item.id }}">@{{ item.alias }}</option>
                </select>
              </div>
              <div class="input-group">
                <span class="input-group-addon">{{trans('admin.website_userinfo_area_xid')}}</span>
                <select  v-model="params_data.area_xid" class="form-control" >
                  <option v-for="item in area_data_x" value="@{{ item.id }}">@{{ item.alias }}</option>
                </select>
              </div>
            </div>

          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button v-else type="button" @click="post_edit_action()" class="btn btn-primary" > <i class="fa fa-hand-peace-o"></i> {{trans('admin.website_action_save')}}</button>
            <button type="button" @click="back_action()" class="btn btn-primary" > <i class="fa fa-reply"></i> {{trans('admin.website_getback')}}</button>
          </div>

      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<script type="text/javascript">
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name=csrf-token]').getAttribute('content')
Vue.http.options.emulateJSON = true;
new Vue({
    el: '#app-content',
    data: {
             apiurl_info:           '{{$website["apiurl_info"]}}', 
             apiurl_edit:           '{{$website["apiurl_edit"]}}',
             apiurl_area:           '{{$website["apiurl_area"]}}', 
             params_data:
             {
                name                :'',
                nick                :'',
                sex                 :0,
                birthday            :'',
                qq                  :'',
                area_pid            :0,
                area_cid            :0,
                area_xid            :0,
                id                  :'{{$website["id"]}}',
             },
             area_data:
             {
               parentid             :0,
               level                :1,
             },
             area_data_p            :eval(htmlspecialchars_decode('{{$website["area_data_p"]}}')),
             area_data_c            :eval(htmlspecialchars_decode('{{$website["area_data_c"]}}')),
             area_data_x            :eval(htmlspecialchars_decode('{{$website["area_data_x"]}}')),
          },
    ready: function ()
    { 
            //这里是vue初始化完成后执行的函数
            this.get_info_action();
    }, 
    methods: 
    {
      //获取数据详情
      get_info_action:function()
      {
        this.$http.post(this.apiurl_info,this.params_data,
        {
          before:function(request)
          {
            loadi=layer.load("...");
          },
        })
        .then((response) => 
        {
          this.ready_info_action(response);
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
      //提交修改数据
      post_edit_action:function()
      {
        this.$http.post(this.apiurl_edit,this.params_data,{
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
      },
      //处理初始化数据
      ready_info_action:function(response)
      {
        layer.close(loadi);
        var statusinfo=response.data;
        if(statusinfo.status==1)
        {
            this.params_data=statusinfo.resource;
            var area_data={'parentid':0,'level':1};
            this.area_action(area_data);
             //获取城市数据
            var area_data={'parentid':statusinfo.resource.area_pid,'level':2};
            this.area_action(area_data);
            //获取乡县数据
            var area_data={'parentid':statusinfo.resource.area_cid,'level':3};
            this.area_action(area_data);
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
      },
      //点击返回
      back_action:function()
      {
        goback();
      },
      //获取地区数据
      area_action:function(area_data)
      {
        this.$http.post(this.apiurl_area,area_data,
        {
          before:function(request)
          {
            loadi=layer.load("...");
          },
        })
        .then((response) => 
        {
          layer.close(loadi);
          var statusinfo=response.data;
          if(statusinfo.status==1)
          {
             switch(area_data.level)
             {
               case 1:
                      this.area_data_p=statusinfo.resource;
               break;
                      
               case 2:
                      this.area_data_c=statusinfo.resource;
               break;

               case 3:
                      this.area_data_x=statusinfo.resource;
               break;
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
        },(response) => 
        {
          //响应错误
          layer.close(loadi);
          var msg="{{trans('admin.website_outtime')}}";
          layermsg_error(msg);
        })
        .catch(function(response) 
        {
          //异常抛出
          layer.close(loadi);
          var msg="{{trans('admin.website_outtime_error')}}";
          layermsg_error(msg);
        })
      },
      //获取城市数据
      get_area_action:function(parentid,level)
      {
        this.area_data.parentid=parentid;
        this.area_data.level=level;
        if(level==2)
        {
          this.area_data_x=eval(htmlspecialchars_decode('{{$website["area_data_x"]}}'));
        }
        this.area_action(this.area_data);
      }
    }               
})

</script>
@endsection