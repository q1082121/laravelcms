@extends('layouts.user')
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

<div class="row-content am-cf" id="app-content">
    <div class="row">
        @include('user.letter.nav')
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title  am-cf">{{$website['cursitename']}}</div>
                </div>
                <div class="widget-body am-fr">
                    <form class="am-form tpl-form-border-form tpl-form-border-br">
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">{{trans('admin.fieldname_item_to_user')}} </label>
                            <div class="am-u-sm-9">
                                <input v-model="params_data.email" onBlur="onBlur_check('email',2);" id="email"  class="form-control" placeholder=": rubbish.boy@163.com ">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label">{{trans('admin.fieldname_item_title')}} </label>
                            <div class="am-u-sm-9">
                                <input v-model="params_data.title" class="form-control" >
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label">{{trans('admin.fieldname_item_content')}} </label>
                            <div class="am-u-sm-9">
                              <div class="editor">
                                @if($website['root']['syseditor']=='Ueditor') 
                                    <textarea id='myEditor'  rows="3" debounce="500" >
                                      @{{params_data.content}}
                                    </textarea>
                                @endif
                                @if($website['root']['syseditor']=='Markdown') 
                                    <textarea id='myEditor'  v-model="params_data.content"  class="form-control"  rows="3"  > 
                                    </textarea>
                                @endif
                              </div>  
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="button" @click="check_action(apiurl_add)" class="am-btn am-btn-primary tpl-btn-bg-color-success ">{{trans('admin.website_action_send')}}</button>
                                <button type="reset"  class="am-btn am-btn-default tpl-btn-bg-color-success ">{{trans('admin.website_action_discard')}}</button>
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
             email:                 '{{$website["website_user"]["email"]}}' ,
             syseditor:             '{{$website["root"]["syseditor"]}}', 
             apiurl_add:            '{{ route("post.user.letter.api_add") }}', 
             apiurl_count           :'{{ route("post.user.letter.api_count") }}',
             params_data:
             {
                syseditor           :'',
                email               :'',
                title               :'',
                content             :'',
             },
             image                  :'',
             cur_title              :'{{trans("admin.website_action_add")}}',
             countdata:
             {
                    count_index    :0,
                    count_send     :0,
                    count_star     :0,
                    count_trash    :0,
             },
          },
    created: function ()
    { 
           this.get_count_action(); 
    }, 
    methods: 
    {
      //获取列表数据
        get_count_action:function()
        {
            this.$http.post(this.apiurl_count,{'email':this.email},{
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
                    this.countdata=statusinfo.resource;
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