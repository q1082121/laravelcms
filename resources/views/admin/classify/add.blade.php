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
              <label >{{trans('admin.website_classify_item_modelid')}} </label>
              <select class="form-control" v-model="params_data.modelid">
                <option v-for="item in modellist" value="@{{ item.value }}">@{{ item.text }}</option>
              </select>
            </div>
            <div class="form-group">
              <label >{{trans('admin.website_classify_item_topclass')}} </label>
              <select class="form-control" v-model="params_data.topid" >
                <option v-for="item in classlist" value="@{{ item.value }}">@{{ item.text }}</option>
              </select>
            </div>
            <div class="form-group">
              <label >{{trans('admin.website_classify_item_name')}}</label>
              <input type="text" class="form-control" v-model="params_data.name"   >
            </div>
            <div class="form-group">
              <label >{{trans('admin.website_classify_item_attachment')}}</label><br>
              <!--
              <input type="file" @change="onFileChange" id="fileuploads" class="file"  accept="image/*">
              
              <p class="help-block">200*200</p>
              <img  v-if="image" :src="image" width="200" height="200" />
              -->
              <!-- file style -->
              <link rel="stylesheet" href="{{asset('/module/jQueryIpputCss')}}/css/style.css">
              <div class="uploader white" v-if="params_data.isattach == 0">
              <input type="text" class="filename" readonly/>
              <input type="button"  name="file" class="button" value="选择图片"/>
              <input type="file" size="30"  @change="onFileChange" />
              <input type="hidden" v-model="params_data.attachment" >
              </div>
              @ability('admin', 'delete')
              <button v-else type="button" @click="del_image_action()"  class="btn btn-block btn-danger btn-lg">删除图片</button>
              @endability
              <p class="help-block">200*200</p>
              <img  v-if="image" :src="image" width="200" height="200" />
              <script>
              document.body.onbeforeunload = function (event)
              {
                  var c = event || window.event;
                  if (/webkit/.test(navigator.userAgent.toLowerCase())) {
                      //return "离开页面将导致数据丢失！";
                     $('.filename').val("尚未选择图片");
                  }
                  else
                  {
                      //c.returnValue = "离开页面将导致数据丢失！";
                      $('.filename').val("尚未选择图片");
                  }
              }
              $(function()
              {
                  $("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
                  $("input[type=file]").each(function(){
                  if($(this).val()==""){$(this).parents(".uploader").find(".filename").val("尚未选择图片");}
                  });
                  
              });
              </script> 

            </div>
            <div class="form-group">
              <label >{{trans('admin.website_classify_item_orderid')}}</label>
              <input type="text" class="form-control" v-model="params_data.orderid"   >
            </div>
            <div class="form-group">
              <label >{{trans('admin.website_classify_item_linkurl')}}</label>
              <input type="text" class="form-control" v-model="params_data.linkurl"   >
            </div>
            <div class="form-group">
                <label >{{trans('admin.website_classify_item_navflag')}}</label>
                <div style="clear:both;display:block;padding-left:10px;"><input type="radio"  value="1" v-model="params_data.navflag" style="margin-right:10px;"> {{trans('admin.website_yes')}}</div>
                <div style="clear:both;display:block;padding-left:10px;"><input type="radio"  value="0" v-model="params_data.navflag" style="margin-right:10px;"> {{trans('admin.website_no')}}</div>
            </div>
            <div class="form-group">
                <label >{{trans('admin.website_classify_item_perpage')}}</label>
                <div style="clear:both;display:block;padding-left:10px;"><input type="radio"  value="1" v-model="params_data.perpage" style="margin-right:10px;"> {{trans('admin.website_perpage')}}</div>
                <div style="clear:both;display:block;padding-left:10px;"><input type="radio"  value="0" v-model="params_data.perpage" style="margin-right:10px;"> {{trans('admin.website_list')}}</div>
            </div>
            <div class="form-group">
                <label >{{trans('admin.website_classify_item_status')}}</label>
                <div style="clear:both;display:block;padding-left:10px;"><input type="radio"  value="1" v-model="params_data.status" style="margin-right:10px;"> {{trans('admin.website_status_on')}}</div>
                <div style="clear:both;display:block;padding-left:10px;"><input type="radio"  value="0" v-model="params_data.status" style="margin-right:10px;"> {{trans('admin.website_status_off')}}</div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button v-if="params_data.id == 0" type="button" @click="add_action()" class="btn btn-primary" > <i class="fa fa-hand-peace-o"></i> {{trans('admin.website_action_save')}}</button>
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
             apiurl_add:            '{{$website["apiurl_add"]}}', 
             apiurl_info:           '{{$website["apiurl_info"]}}', 
             apiurl_edit:           '{{$website["apiurl_edit"]}}',
             apiurl_del_image:      '{{$website["apiurl_del_image"]}}',
             classlist:             eval(htmlspecialchars_decode('{{$website["classlist"]}}')), 
             modellist:             eval(htmlspecialchars_decode('{{$website["modellist"]}}')), 
             params_data:
             {
                modelid             :1,
                topid               :0,
                name                :'',
                attachment          :'',
                isattach            :0,
                orderid             :0,
                linkurl             :'',
                navflag             :0,
                perpage             :1,
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
             }
          },
    ready: function (){ 
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
      //选择图片
      onFileChange:function(e) {
        var files = e.target.files || e.dataTransfer.files;
        if (!files.length)
          return;
        this.createImage(files[0]);
      },
      //创建图片
      createImage:function(file) 
      {
        var image = new Image();
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = (e) => {
          this.params_data.attachment=e.target.result;
          this.image=e.target.result;
          //console.log(this.params_data.attachment);
        };
      },
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
      //点击数据验证
      add_action:function()
      {
          if (this.params_data.name=='')
          {
              var msg="{{trans('admin.classify_failure_tip1')}}";
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
        this.$http.post(this.apiurl_add,this.params_data,{
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

            //console.log(this.params_data);
            if(this.params_data.attachment)
            {
              this.image="/uploads/classify/thumb/"+this.params_data.attachment;
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
      del_image_action:function(classname)
      {
        this.del_data.classname=classname;
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
          var msg="{{trans('admin.website_outtime')}}";
          layermsg_error(msg);
        })
        .catch(function(response) {
          //异常抛出
          layer.close(loadi);
          var msg="{{trans('admin.website_outtime_error')}}";
          layermsg_error(msg);
        })
      }
    }               
})

</script>
@endsection