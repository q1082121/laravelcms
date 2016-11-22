@extends('layouts.user')
@section('content')

<div class="row-content am-cf" id="app-content" >
  <div class="row">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title am-fl"><span class="am-icon-home page-header-heading-icon"></span> {{trans('admin.define_model_user_editpwd')}}</div>
                <div class="widget-function am-fr">
                    <a href="javascript:;" class="am-icon-cog"></a>
                </div>
            </div>
            <div class="widget-body am-fr">
                <form class="am-form tpl-form-border-form tpl-form-border-br">
                    <div class="am-form-group">
                        <label for="user-name" class="am-u-sm-3 am-form-label">{{trans('admin.fieldname_item_editpwd_old')}} </label>
                        <div class="am-u-sm-9">
                            <input type="password" class="tpl-form-input" v-model="params_data.oldpwd" >
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">{{trans('admin.fieldname_item_editpwd_new')}} </label>
                        <div class="am-u-sm-9">
                            <input type="password" class="tpl-form-input"  v-model="params_data.newpwd" >
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">{{trans('admin.fieldname_item_editpwd_sure')}} </label>
                        <div class="am-u-sm-9">
                            <input type="password" class="tpl-form-input"  v-model="params_data.surepwd" >
                        </div>
                    </div>
                    <div class="am-form-group">
                        <div class="am-u-sm-9 am-u-sm-push-3">
                            <button type="button" @click="edit_action()" class="am-btn am-btn-primary tpl-btn-bg-color-success ">{{trans('admin.website_action_save')}}</button>
                            <button type="button" @click="back_action()" class="am-btn am-btn-default tpl-btn-bg-color-success ">{{trans('admin.website_action_getback')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
new Vue({
    el: '#app-content',
    data: {
             apiurl_edit_pwd:         '{{route("post.user.userinfo.api_edit_pwd")}}', 
             params_data:
             {
                oldpwd                :'',
                newpwd                :'',
                surepwd               :'',
                id                    :'{{$website["id"]}}',
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