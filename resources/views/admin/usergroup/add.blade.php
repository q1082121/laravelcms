@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
  <!-- row -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box" id="app-content">
        <div class="box-header">
          <h3 class="box-title">{{trans('admin.website_navigation_role')}} 【@{{ cur_title }}】 </h3>
        </div>
        <!-- /.box-header -->

          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">{{trans('admin.website_usergroup_item_name')}} </label>
              <input type="text" class="form-control" v-model="params_data.name"  placeholder="示例：admin "  disabled="@{{disabled}}"  >
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">{{trans('admin.website_usergroup_item_display_name')}}</label>
              <input type="text" class="form-control" v-model="params_data.display_name"  placeholder="示例：管理员" >
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">{{trans('admin.website_usergroup_item_description')}}</label>
              <input type="text" class="form-control" v-model="params_data.description"  placeholder="示例：管理员会员组拥有全部权限" >
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button v-if="id == 0" type="button" @click="add_action()" class="btn btn-primary" >{{trans('admin.website_action_save')}}</button>
            <button v-else type="button" @click="edit_action()" class="btn btn-primary" >{{trans('admin.website_action_edit')}}</button>
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
             apiUrl:                '/admin/usergroup/api_add', 
             params_data:
             {
                name                :'',
                display_name        :'',
                description         :'',
                id                  :'{{$website["id"]}}',
             },
             cur_title              :'',
             cur_title_add          :'{{trans("admin.website_action_add")}}',
             cur_title_edit         :'{{trans("admin.website_action_edit")}}',
             disabled               :'false',
          },
    ready: function (){ 
            //这里是vue初始化完成后执行的函数 
            if(this.params_data.id>0)
            {
                this.cur_title=this.cur_title_edit;
                this.disabled='true';
            }
            else
            {
                this.cur_title=this.cur_title_add;
            }
    }, 
    methods: 
    {
      add_action:function()
      {
          if (this.params_data.name=='')
          {
              var msg="{{trans('admin.usergroup_failure_tip1')}}";
              layermsg_error(msg);
          }
          else
          {
              this.post_add_action();
          }
      },
      //提交数据
      post_add_action:function()
      {

        this.$http.post(this.apiUrl,this.params_data,{
          before:function(request)
          {
            loadi=layer.load("等待中...");
          },
        })
        .then((response) => 
        {
          this.return_info_action(response);

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
      }

    }               
})

</script>
@endsection