@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
  <!-- row -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box" id="app-content">
        <div class="box-header">
          <h3 class="box-title"> 【 @{{cur_title}} 】</h3>
        </div>
        <!-- /.box-header -->
          
          <div class="box-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_keyword')}}</span>
                <input type="text" class="form-control" v-model="params_data.keyword"   >
              </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_content')}}</span>
                  <textarea  class="form-control" rows="3" v-model="params_data.content" > </textarea>
                </div>
            </div>
            <div class="form-group">
                <label >{{trans('admin.fieldname_item_status')}}</label>
                <div style="padding-left:10px;"><input type="radio"  value="1" v-model="params_data.status" style="margin-right:10px;"> {{trans('admin.website_status_on')}}</div>
                <div style="padding-left:10px;"><input type="radio"  value="0" v-model="params_data.status" style="margin-right:10px;"> {{trans('admin.website_status_off')}}</div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button v-if="params_data.id == 0" type="button" @click="check_action(apiurl_add)" class="btn btn-primary" > <i class="fa fa-hand-peace-o"></i> {{trans('admin.website_action_save')}}</button>
            <button v-else type="button" @click="check_action(apiurl_edit)" class="btn btn-primary" > <i class="fa fa-hand-peace-o"></i> {{trans('admin.website_action_save')}}</button>
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
             apiurl_add:            '{{ route("post.admin.wechatreplytext.api_add") }}', 
             apiurl_info:           '{{ route("post.admin.wechatreplytext.api_info") }}', 
             apiurl_edit:           '{{ route("post.admin.wechatreplytext.api_edit") }}',
             params_data:
             {
                wechat_id           :'{{$website["wechat_id"]}}',
                keyword             :'',
                content             :'',
                status              :1,
                id                  :'{{$website["id"]}}',
             },
             image                  :'',
             cur_title              :'',
             cur_title_add          :'{{trans("admin.website_action_add")}}',
             cur_title_edit         :'{{trans("admin.website_action_edit")}}',
             del_data:
             {
                id                  :'{{$website["id"]}}',
                modelname           :'{{getCurrentControllerName()}}',
             }
          },
    created: function (){ 
            //这里是vue初始化完成后执行的函数 
            if(this.params_data.id>0)
            {
                this.cur_title=this.cur_title_edit;
                this.get_info_action();
            }
            else
            {
                this.cur_title=this.cur_title_add;
            }
    }, 
    methods: 
    {
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
      //点击数据验证
      check_action:function(posturl)
      {

          if (this.params_data.keyword=='')
          {
              var msg="{{trans('admin.option_failure_iskeyword')}}";
              layermsg_error(msg);
          }
          else if (this.params_data.content=='')
          {
              var msg="{{trans('admin.option_failure_iscontent')}}";
              layermsg_error(msg);
          }
          else
          {
              this.post_action(posturl);
          }
      },
      //提交数据
      post_action:function(posturl)
      {
        this.$http.post(posturl,this.params_data,{
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

            //console.log(this.params_data);
            if(this.params_data.attachment)
            {
              this.image="/uploads/"+this.del_data.modelname+"/thumb/"+this.params_data.attachment;
              this.params_data.attachment="";
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
      //点击返回
      back_action:function()
      {
        goback();
      },
      del_image_action:function()
      {
        this.$http.post(this.apiurl_del_image,this.del_data,{
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
      }
    }               
})

</script>
@endsection