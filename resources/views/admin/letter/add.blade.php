@extends('layouts.admin')
@section('content')

@if($website['root']['syseditor']=='Ueditor')
<!--处理UEditor start--> 
@include('UEditor::head');
<!-- 实例化编辑器 -->
<script type="text/javascript">
  var ueditors;
</script>
<!--处理UEditor end  -->
@endif

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
                <span class="input-group-addon">{{trans('admin.website_article_item_classid')}}</span>
                <select class="form-control"  v-model="params_data.classid" >
                  <option v-for="item in classlist" value="@{{ item.value }}">@{{ item.text }}</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">{{trans('admin.website_article_item_title')}}</span>
                <input  type="text" class="form-control" v-model="params_data.title"   >
              </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_article_item_introduction')}}</span>
                  <textarea  class="form-control" rows="3" v-model="params_data.introduction" > </textarea>
                </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">{{trans('admin.website_article_item_sources')}}</span>
                <input  type="text" class="form-control" v-model="params_data.sources"   >
              </div>
            </div>
            <!--图片上传控件 start-->
            <div class="form-group">
              <label >{{trans('admin.website_classify_item_attachment')}}</label><br>
              <link rel="stylesheet" href="{{asset('/module/jQueryIpputCss')}}/css/style.css">
              <div class="uploader white" v-if="params_data.isattach == 0">
              <input type="text" class="filename" readonly/>
              <input type="button"  name="file" class="button" value="选择图片"/>
              <input type="file" size="30"  @change="onFileChange" />
              <input type="hidden"  v-model="params_data.attachment" >
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
            <!--图片上传控件 end-->
            @if($website['root']['syseditor']=='Ueditor')
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_article_item_content')}}</span>
                  <div class="editor">
                    <textarea id='myEditor'  rows="3" debounce="500" >
                      @{{params_data.content}}
                    </textarea>
                  </div>
                </div>
            </div>
            @endif

            @if($website['root']['syseditor']=='Markdown') 
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">{{trans('admin.website_article_item_content')}}</span>
                  <div class="editor">
                    <textarea id='myEditor'  v-model="params_data.content"  class="form-control"  rows="3"  >
                    </textarea>
                  </div>
                </div>
            </div>
            @endif

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">{{trans('admin.website_classify_item_orderid')}}</span>
                <input   type="text" class="form-control" v-model="params_data.orderid"   >
              </div>  
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">{{trans('admin.website_classify_item_linkurl')}}</span>
                <input  type="text" class="form-control" v-model="params_data.linkurl"   >
              </div>
            </div>
            <div class="form-group">
                <label >{{trans('admin.website_classify_item_status')}}</label>
                <div style="padding-left:10px;"><input  type="radio"  value="1" v-model="params_data.status" style="margin-right:10px;"> {{trans('admin.website_status_on')}}</div>
                <div style="padding-left:10px;"><input  type="radio"  value="0" v-model="params_data.status" style="margin-right:10px;"> {{trans('admin.website_status_off')}}</div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button v-if="params_data.id == 0" type="button" @click="check_action(apiurl_add)" class="btn btn-primary" > <i class="fa fa-hand-peace-o"></i> {{trans('admin.website_action_save')}}</button>
            <button v-else type="button" @click="check_action(apiurl_edit)" class="btn btn-primary" > <i class="fa fa-hand-peace-o"></i> {{trans('admin.website_action_save')}}</button>
            <button type="button" @click="back_action()" class="btn btn-primary" > <i class="fa fa-reply"></i> {{trans('admin.website_getback')}}</button>
          </div>

      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <a href="mailbox.html" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>

      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Folders</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="mailbox.html"><i class="fa fa-inbox"></i> Inbox
              <span class="label label-primary pull-right">12</span></a></li>
            <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
            <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
            <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
            </li>
            <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Labels</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Compose New Message</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <input class="form-control" placeholder="To:">
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Subject:">
          </div>
          <div class="form-group">
                <textarea id="compose-textarea" class="form-control" style="height: 300px">
                  <h1><u>Heading Of Message</u></h1>
                  <h4>Subheading</h4>
                  <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                    was born and I will give you a complete account of the system, and expound the actual teachings
                    of the great explorer of the truth, the master-builder of human happiness. No one rejects,
                    dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know
                    how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again
                    is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain,
                    but because occasionally circumstances occur in which toil and pain can procure him some great
                    pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise,
                    except to obtain some advantage from it? But who has any right to find fault with a man who
                    chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that
                    produces no resultant pleasure? On the other hand, we denounce with righteous indignation and
                    dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so
                    blinded by desire, that they cannot foresee</p>
                  <ul>
                    <li>List item one</li>
                    <li>List item two</li>
                    <li>List item three</li>
                    <li>List item four</li>
                  </ul>
                  <p>Thank you,</p>
                  <p>John Doe</p>
                </textarea>
          </div>
          <div class="form-group">
            <div class="btn btn-default btn-file">
              <i class="fa fa-paperclip"></i> Attachment
              <input type="file" name="attachment">
            </div>
            <p class="help-block">Max. 32MB</p>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="pull-right">
            <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
          </div>
          <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
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
             syseditor:             '{{$website["root"]["syseditor"]}}', 
             apiurl_add:            '{{$website["apiurl_add"]}}', 
             params_data:
             {
                syseditor           :'',
                title               :'',
                content             :'',
             },
             image                  :'',
             cur_title              :'{{trans("admin.website_action_add")}}',
          },
    ready: function ()
    { 
            
    }, 
    methods: 
    {
      //点击数据验证
      check_action:function(posturl)
      {
          if (this.params_data.classid==0)
          {
              var msg="{{trans('admin.website_article_select')}}";
              layermsg_error(msg);
          }
          else if (this.params_data.title=='')
          {
              var msg="{{trans('admin.article_failure_tip1')}}";
              layermsg_error(msg);
          }
          else
          {
            this.params_data.syseditor=this.syseditor;
             this.post_action(posturl);
          }
      },
      //提交数据
      post_action:function(posturl)
      {
        
        if(this.syseditor=="Ueditor")
        {
          this.params_data.content=ueditors.getContent();
        }
        if(this.syseditor=="Markdown")
        {
          this.params_data.content=myEditor.codemirror.getValue();
        } 

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
      //点击返回
      back_action:function()
      {
        goback();
      },
    }               
})

</script>

@if($website['root']['syseditor']=='Markdown')
<!--处理markdown 弹窗锁定层兼容问题 -->
@include('editor::head')
<style>
.modal-backdrop{display:none}
</style>
<!--处理markdown 弹窗锁定层兼容问题 -->
@endif

@endsection