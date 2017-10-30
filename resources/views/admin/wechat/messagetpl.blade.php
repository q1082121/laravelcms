@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
  <!-- row -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box" id="app-content">
        <div class="box-header">
          <h3 class="box-title"> 【 @{{cur_title}} 】 </h3>
        </div>
        <!-- /.box-header -->
          <div class="box-body">
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_openid_items')}}</span>
                  <textarea  class="form-control" rows="3" v-model="params_data.openid_items" > </textarea>
                </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_temp_name1')}}</span>
                <input type="text" class="form-control" v-model="params_data.temp_name1"   >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_temp_id1')}}</span>
                <input type="text" class="form-control" v-model="params_data.temp_id1"   >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_temp_name2')}}</span>
                <input type="text" class="form-control" v-model="params_data.temp_name2"   >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_temp_id2')}}</span>
                <input type="text" class="form-control" v-model="params_data.temp_id2"   >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_temp_name3')}}</span>
                <input type="text" class="form-control" v-model="params_data.temp_name3"   >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_temp_id3')}}</span>
                <input type="text" class="form-control" v-model="params_data.temp_id3"   >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_temp_name4')}}</span>
                <input type="text" class="form-control" v-model="params_data.temp_name4"   >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_temp_id4')}}</span>
                <input type="text" class="form-control" v-model="params_data.temp_id4"   >
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="button" @click="check_action(apiurl_edit)" class="btn btn-primary" > <i class="fa fa-hand-peace-o"></i> {{trans('admin.website_action_save')}}</button>
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
             apiurl_info:           '{{ route("post.admin.wechat.api_info") }}', 
             apiurl_edit:           '{{ route("post.admin.wechat.api_edit") }}',
             params_data:
             {
                openid_items        :'',
                temp_name1          :'',
                temp_id1            :'',
                temp_name2          :'',
                temp_id2            :'',
                temp_name3          :'',
                temp_id3            :'',
                temp_name4          :'',
                temp_id4            :'',
                id                  :'{{$website["id"]}}',
             },
             image                  :'',
             cur_title              :'',
             cur_title_edit         :'{{trans("admin.website_navigation_messagetpl_reply")}}',
             del_data:
             {
                id                  :'{{$website["id"]}}',
                modelname           :'{{getCurrentControllerName()}}',
             }
          },
    created: function (){ 
            //这里是vue初始化完成后执行的函数 
            this.cur_title=this.cur_title_edit;
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
        this.post_action(posturl);
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
            this.params_data.waytype="{{$website['waytype']}}";
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