@extends('layouts.user')
@section('content')
<div class="row-content am-cf" id="app-content" >
  <div class="row">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title am-fl"><span class="am-icon-home page-header-heading-icon"></span> {{trans('admin.website_navigation_userinfo')}}</div>
                <div class="widget-function am-fr">
                    <a href="javascript:;" class="am-icon-cog"></a>
                </div>
            </div>
            <div class="widget-body am-fr">
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
                <form class="am-form tpl-form-border-form tpl-form-border-br">
                    <div class="am-form-group">
                        <label for="user-name" class="am-u-sm-3 am-form-label">{{trans('admin.fieldname_item_fullname')}} </label>
                        <div class="am-u-sm-9">
                            <input type="text" class="tpl-form-input" v-model="params_data.name" placeholder="">
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">{{trans('admin.fieldname_item_nick')}} </label>
                        <div class="am-u-sm-9">
                            <input type="text" class="tpl-form-input"  v-model="params_data.nick" >
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label class="am-u-sm-3 am-form-label">{{trans('admin.fieldname_item_birthday')}} </label>
                        <div class="am-u-sm-9">
                            <input type="text" class="tpl-form-input" v-model="params_data.birthday"  data-field="date" data-format="yyyy-MM-dd" readonly >
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-weibo" class="am-u-sm-3 am-form-label">{{trans('admin.fieldname_item_headimage')}} </label>
                        <div class="am-u-sm-9">
                                <!--图片上传控件 start-->
                                  <link rel="stylesheet" href="{{asset('/module/jQueryIpputCss')}}/css/style.css">
                                  <div class="uploader white" v-if="params_data.isattach == 0">
                                    <input type="text" class="filename" readonly style="display:none" />
                                    <input type="button"  name="file" class="button" value="选择图片" />
                                    <input type="file" size="30"  @change="onFileChange" />
                                    <input type="hidden"  v-model="params_data.attachment" >
                                  </div>
                                  <button v-else type="button" @click="del_image_action()"  class="btn btn-block btn-danger btn-lg">删除图片</button>
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
                                <!--图片上传控件 end-->
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">{{trans('admin.fieldname_item_qq')}} </label>
                        <div class="am-u-sm-9">
                            <input type="text" class="tpl-form-input"  v-model="params_data.qq" >
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">{{trans('admin.fieldname_item_area_pid')}} </label>
                        <div class="am-u-sm-9">
                            <select @change="get_area_action(params_data.area_pid,2)" v-model="params_data.area_pid" class="form-control" >
                              <option v-for="item in area_data_p" value="@{{ item.id }}">@{{ item.alias }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">{{trans('admin.fieldname_item_area_cid')}} </label>
                        <div class="am-u-sm-9">
                            <select @change="get_area_action(params_data.area_cid,3)" v-model="params_data.area_cid" class="form-control" >
                              <option v-for="item in area_data_c" value="@{{ item.id }}">@{{ item.alias }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-email" class="am-u-sm-3 am-form-label">{{trans('admin.fieldname_item_area_xid')}} </label>
                        <div class="am-u-sm-9">
                            <select  v-model="params_data.area_xid" class="form-control" >
                              <option v-for="item in area_data_x" value="@{{ item.id }}">@{{ item.alias }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <div class="am-u-sm-9 am-u-sm-push-3">
                            <button type="button" @click="post_edit_action()" class="am-btn am-btn-primary tpl-btn-bg-color-success ">{{trans('admin.website_action_save')}}</button>
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
             apiurl_info:           '{{route("post.user.userinfo.api_info")}}', 
             apiurl_edit:           '{{route("post.user.userinfo.api_edit")}}',
             apiurl_area:           '{{route("post.user.district.api_area")}}', 
             apiurl_del_image:      '{{route("post.user.deleteapi.api_del_image")}}',
             params_data:
             {
                name                :'',
                nick                :'',
                attachment          :'',
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
             image                  :'',
             del_data:
             {
                id                  :'{{$website["website_userinfo"]["id"]}}',
                modelname           :'{{getCurrentControllerName("User")}}',
             }
          },
    created: function ()
    { 
            //这里是vue初始化完成后执行的函数
            this.get_info_action();
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

            if(this.params_data.attachment)
            {
              this.image="/uploads/"+this.del_data.modelname+"/thumb/"+this.params_data.attachment;
              this.params_data.attachment="";
            }

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
          var msg="{{trans('admin.message_outtime')}}";
          layermsg_error(msg);
        })
        .catch(function(response) 
        {
          //异常抛出
          layer.close(loadi);
          var msg="{{trans('admin.message_error')}}";
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
      },
    }               
})

</script>
@endsection