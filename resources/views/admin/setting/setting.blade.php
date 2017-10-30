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
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_systitle')}}</span>
                  <input type="text" class="form-control"  v-model="info.systitle"   placeholder="例如：LaravelCms内容管理系统" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_syskeyword')}}</span>
                  <input type="text" class="form-control"  v-model="info.syskeywords"   placeholder="例如：LaravelCms" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_sysdescription')}}</span>
                  <textarea class="form-control" rows="3"  v-model="info.sysdescription" placeholder="例如：LaravelCms内容管理系统"></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_sysicp')}}</span>
                  <input type="text" class="form-control"  v-model="info.sysicp"   placeholder="例如：浙ICP备15022520号-1" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_sysmaster')}}</span>
                  <input type="text" class="form-control"  v-model="info.sysmaster"  placeholder="例如：管理员" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_sysemail')}}</span>
                  <input type="text" class="form-control"  v-model="info.sysemail"  placeholder="例如：admin@admin.com" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_sysmobile')}}</span>
                  <input type="text" class="form-control"  v-model="info.sysmobile"  placeholder="例如：15011112222" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_sysfax')}}</span>
                  <input type="text" class="form-control"  v-model="info.sysfax"   placeholder="例如：15011112222" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_sysqq')}}</span>
                  <input type="text" class="form-control"  v-model="info.sysqq"   placeholder="例如：471416739" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_syswechat')}}</span>
                  <input type="text" class="form-control"  v-model="info.syswechat"  placeholder="例如：XBDtommy" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_syscompany')}}</span>
                  <input type="text" class="form-control"  v-model="info.syscompany"   placeholder="例如：LaravelCms有限公司" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_sysaddress')}}</span>
                  <input type="text" class="form-control"  v-model="info.sysaddress"   placeholder="例如：浙江省台州市温岭市XX街道XX村XX号" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_syscoordinate_h')}}</span>
                  <input type="text" class="form-control"  v-model="info.syscoordinate_h"   placeholder="例如北京：39.915053" >
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_syscoordinate_w')}}</span>
                  <input type="text" class="form-control"  v-model="info.syscoordinate_w"   placeholder="例如北京：116.403951" >
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-header with-border">
              <h3 class="box-title">{{trans('admin.website_setting_option')}}</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon minwidth">{{trans('admin.website_setting_editor_type')}}</span>
                    <select class="form-control" v-model="info.syseditor" >
                      <option v-for="item in editoroption" value="@{{ item.value }}">@{{ item.text }}</option>
                    </select>
                  </div>
              </div>
            </duv>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_navigation_thumb_width')}}</span>
                  <input type="text" class="form-control"  v-model="info.navigation_thumb_width"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_navigation_thumb_height')}}</span>
                  <input type="text" class="form-control"  v-model="info.navigation_thumb_height"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_classify_thumb_width')}}</span>
                  <input type="text" class="form-control"  v-model="info.classify_thumb_width"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_classify_thumb_height')}}</span>
                  <input type="text" class="form-control"  v-model="info.classify_thumb_height"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_article_thumb_width')}}</span>
                  <input type="text" class="form-control"  v-model="info.article_thumb_width"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_article_thumb_height')}}</span>
                  <input type="text" class="form-control"  v-model="info.article_thumb_height"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_picture_thumb_width')}}</span>
                  <input type="text" class="form-control"  v-model="info.picture_thumb_width"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_picture_thumb_height')}}</span>
                  <input type="text" class="form-control"  v-model="info.picture_thumb_height"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_classifylink_thumb_width')}}</span>
                  <input type="text" class="form-control"  v-model="info.classifylink_thumb_width"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_classifylink_thumb_height')}}</span>
                  <input type="text" class="form-control"  v-model="info.classifylink_thumb_height"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_classifyquestion_thumb_width')}}</span>
                  <input type="text" class="form-control"  v-model="info.classifyquestion_thumb_width"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_classifyquestion_thumb_height')}}</span>
                  <input type="text" class="form-control"  v-model="info.classifyquestion_thumb_height"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_link_thumb_width')}}</span>
                  <input type="text" class="form-control"  v-model="info.link_thumb_width"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_link_thumb_height')}}</span>
                  <input type="text" class="form-control"  v-model="info.link_thumb_height"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_question_thumb_width')}}</span>
                  <input type="text" class="form-control"  v-model="info.question_thumb_width"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_question_thumb_height')}}</span>
                  <input type="text" class="form-control"  v-model="info.question_thumb_height"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_questionoption_thumb_width')}}</span>
                  <input type="text" class="form-control"  v-model="info.questionoption_thumb_width"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_questionoption_thumb_height')}}</span>
                  <input type="text" class="form-control"  v-model="info.questionoption_thumb_height"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_user_thumb_width')}}</span>
                  <input type="text" class="form-control"  v-model="info.user_thumb_width"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_user_thumb_height')}}</span>
                  <input type="text" class="form-control"  v-model="info.user_thumb_height"   placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_wechat_thumb_width')}}</span>
                  <input type="text" class="form-control"  v-model="info.wechat_thumb_width"  placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_wechat_thumb_height')}}</span>
                  <input type="text" class="form-control"  v-model="info.wechat_thumb_height"  placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_wechatreplyimagetext_thumb_width')}}</span>
                  <input type="text" class="form-control"  v-model="info.wechatreplyimagetext_thumb_width"  placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_wechatreplyimagetext_thumb_height')}}</span>
                  <input type="text" class="form-control"  v-model="info.wechatreplyimagetext_thumb_height"  placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_productattribute_thumb_width')}}</span>
                  <input type="text" class="form-control"  v-model="info.productattribute_thumb_width"  placeholder="默认200px" >
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon minwidth">{{trans('admin.website_setting_productattribute_thumb_height')}}</span>
                  <input type="text" class="form-control"  v-model="info.productattribute_thumb_height"  placeholder="默认200px" >
                </div>
            </div>
            <div class="box-footer">
              <center><button @click="saveaction" type="button" class="btn btn-primary">{{trans('admin.website_action_save')}}</button> <button @click="getbackaction" type="button" class="btn btn-primary">{{trans('admin.website_action_getback')}}</button></center>
            </div>
        
        
          </div>
        <!-- /.box -->
    </section>
    <script type="text/javascript">
      new Vue({
          el: '#app-content',
          data: {
              apiurl_info:        '{{ route("post.admin.setting.api_info") }}',
              apiurl_cache:       '{{ route("post.admin.cacheapi.api_cache") }}',
              editoroption        :eval(htmlspecialchars_decode('{{$website["editoroption"]}}')),
              info: {
                systitle:         '' ,
                syskeywords:      '' ,
                sysdescription :  '' ,
                sysicp:           '' ,
                sysmaster:        '' ,
                sysemail:         '' ,
                sysmobile:        '' ,
                sysfax:           '' ,
                sysqq:            '' ,
                syswechat:        '' ,
                syscompany:       '' ,
                sysaddress:       '' ,
                syscoordinate_h:  '' ,
                syscoordinate_w:  '' ,
                syseditor:        '' ,
                classify_thumb_width:         '' ,
                classify_thumb_height:        '' ,
                article_thumb_width:          '' ,
                article_thumb_height:         '' ,
                picture_thumb_width:          '' ,
                picture_thumb_height:         '' ,
                classifylink_thumb_width:     '' ,
                classifylink_thumb_height:    '' ,
                classifyquestion_thumb_width: '' ,
                classifyquestion_thumb_height:'' ,
                link_thumb_width:             '' ,
                link_thumb_height:            '' ,
                user_thumb_width:             '' ,
                user_thumb_height:            '' ,
                wechat_thumb_width:           '' ,
                wechat_thumb_height:          '' ,
                wechatreplyimagetext_thumb_width:'',
                wechatreplyimagetext_thumb_height:'',
                productattribute_thumb_width: '',
                productattribute_thumb_height:'',
                modelname:        '{{getCurrentControllerName()}}' ,
              }
          },
          created: function (){ 
                 //这里是vue初始化完成后执行的函数 
                 this.get_info_action();
          }, 
          methods: 
          {
            //获取数据详情
            get_info_action:function()
            {

              this.$http.post(this.apiurl_info,{'modelname':this.info.modelname},
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
            //处理初始化数据
            ready_info_action:function(response)
            {
              layer.close(loadi);
              var statusinfo=response.data;
              if(statusinfo.status==1)
              {
                  this.info=statusinfo.resource;
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
            getbackaction:function () {
              history.go(-1);
            }
          }
      })
    </script>
<!-- /.content -->
@endsection