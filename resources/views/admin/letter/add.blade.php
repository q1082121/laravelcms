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
  <div class="row" id="app-content">
    <div class="col-md-3">
      <a href="/admin/letter" class="btn btn-primary btn-block margin-bottom">{{trans('admin.website_action_goback')}} {{trans('admin.website_navigation_letter')}}</a>
      @include('admin.letter.nav')
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{trans('admin.website_action_add_letter')}}</h3>
        </div>
        <!-- /.box-header -->
        <form>
        <div class="box-body">
          
          <div class="form-group">
            <input v-model="params_data.email" onBlur="onBlur_check('email',2);" id="email"  class="form-control" placeholder="{{trans('admin.fieldname_item_to_user')}} : rubbish.boy@163.com ">
          </div>
          <div class="form-group">
            <input v-model="params_data.title" class="form-control" placeholder="{{trans('admin.fieldname_item_title')}} : ">
          </div>
          <!--图片上传控件 end-->
          @if($website['root']['syseditor']=='Ueditor')
          <div class="form-group">
              <div class="editor">
                <textarea id='myEditor'  rows="3" debounce="500" >
                  @{{params_data.content}}
                </textarea>
              </div>
          </div>
          @endif

          @if($website['root']['syseditor']=='Markdown') 
          <div class="form-group">
              <div class="editor">
                <textarea id='myEditor'  v-model="params_data.content"  class="form-control"  rows="3"  >
                </textarea>
              </div>
          </div>
          @endif
        </div>
        
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="pull-right">
            <button type="button" @click="check_action(apiurl_add)"  class="btn btn-primary"><i class="fa fa-envelope-o"></i> {{trans('admin.website_action_send')}} </button>
          </div>
          <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> {{trans('admin.website_action_discard')}}</button>
        </div>
        </form>
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
new Vue({
    el: '#app-content',
    data: { 
             email:                 '{{$website["website_user"]["email"]}}' ,
             syseditor:             '{{$website["root"]["syseditor"]}}', 
             apiurl_add:            '{{ route("post.admin.letter.api_add") }}', 
             params_data:
             {
                syseditor           :'',
                email               :'',
                title               :'',
                content             :'',
             },
             image                  :'',
             cur_title              :'{{trans("admin.website_action_add")}}',
          },
    created: function ()
    { 
            
    }, 
    methods: 
    {
      //点击数据验证
      check_action:function(posturl)
      {
          if (this.params_data.email=="")
          {
              var msg="{{trans('admin.fieldname_item_to_user')}}";
              layermsg_error(msg);
          }
          else if (this.params_data.email==this.email)
          {
              var msg="{{trans('admin.option_letter_failure_tip1')}}";
              layermsg_error(msg);
          }
          else if (this.params_data.title=='')
          {
              var msg="{{trans('admin.option_failure_istitle')}}";
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