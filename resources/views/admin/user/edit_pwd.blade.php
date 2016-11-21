@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
  <!-- row -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box" id="app-content">
        <div class="box-header">
          <h3 class="box-title"> 【{{trans('admin.define_model_user_editpwd')}} 】 </h3>
        </div>
        <!-- /.box-header -->
          <div class="box-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_editpwd_old')}}</span>
                <input type="password" class="form-control" v-model="params_data.oldpwd" >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_editpwd_new')}}</span>
                <input type="password" class="form-control" v-model="params_data.newpwd" >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_editpwd_sure')}}</span>
                <input type="password" class="form-control" v-model="params_data.surepwd" >
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button v-else type="button" @click="edit_action()" class="btn btn-primary" > <i class="fa fa-hand-peace-o"></i> {{trans('admin.website_action_save')}}</button>
            <button type="button" @click="back_action()" class="btn btn-primary" > <i class="fa fa-reply"></i> {{trans('admin.website_action_getback')}}</button>
          </div>

      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<script type="text/javascript">
new Vue({
    el: '#app-content',
    data: {
             apiurl_edit_pwd:           '{{ route("post.admin.user.api_edit_pwd") }}', 
             params_data:
             {
                oldpwd                :'',
                newpwd                :'',
                surepwd               :'',
                id                  :'{{$website["id"]}}',
             },
          },
    methods: 
    {
      edit_action:function()
      {

        if(this.params_data.oldpwd=="")
        {
          var msg="{{trans('admin.option_editpwd_failure_tip1')}}";
          layermsg_error(msg);
        }
        else if(this.params_data.newpwd=="")
        {
          var msg="{{trans('admin.option_editpwd_failure_tip2')}}";
          layermsg_error(msg);
        }
        else if(this.params_data.newpwd==this.params_data.oldpwd)
        {
          var msg="{{trans('admin.option_editpwd_failure_tip3')}}";
          layermsg_error(msg);
          this.params_data.newpwd="";
          this.params_data.surepwd="";
        }
        else if(this.params_data.newpwd.length<6)
        {
          var msg="{{trans('admin.option_editpwd_failure_tip4')}}";
          layermsg_error(msg);
          this.params_data.newpwd="";
          this.params_data.surepwd="";
        }
        else if(this.params_data.surepwd=="")
        {
          var msg="{{trans('admin.option_editpwd_failure_tip5')}}";
          layermsg_error(msg);
        }
        else if(this.params_data.surepwd!=this.params_data.newpwd)
        {
          var msg="{{trans('admin.option_editpwd_failure_tip6')}}";
          layermsg_error(msg);
          this.params_data.surepwd="";
        }
        else
        {
          this.post_edit_action();
        }

      },
      //提交修改数据
      post_edit_action:function()
      {
        this.$http.post(this.apiurl_edit_pwd,this.params_data,{
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
              }
            }
        }
        else
        {
            this.params_data.oldpwd="";

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