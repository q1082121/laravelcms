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

          <div class="box-body">
            <div class="form-group">
              <label >{{trans('admin.website_userinfo_name')}} </label>
              <input type="text" id="name" class="form-control" v-model="params_data.name"    >
            </div>
            <div class="form-group">
              <label >{{trans('admin.website_userinfo_nick')}}</label>
              <input type="text" class="form-control" v-model="params_data.nick"   >
            </div>
            <div class="form-group">
              <label >{{trans('admin.website_userinfo_sex')}}</label>
              
            </div>
            <div class="form-group">
              <label >{{trans('admin.website_userinfo_birthday')}}</label>
              <input type="text" class="form-control" v-model="params_data.birthday"   >
            </div>
            <div class="form-group">
              <label >{{trans('admin.website_userinfo_qq')}}</label>
              <input type="text" class="form-control" v-model="params_data.qq"   >
            </div>
            <div class="form-group">
              <label >{{trans('admin.website_userinfo_area')}}</label>
              
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
             params_data:
             {
                name                :'',
                nick                :'',
                sex                 :'',
                birthday            :'',
                id                  :'{{$website["id"]}}',
             },
          },
    ready: function (){ 
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
      }
    }               
})

</script>
@endsection