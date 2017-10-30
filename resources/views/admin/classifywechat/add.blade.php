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
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_topclass')}}</span>
                <select class="form-control" v-model="params_data.topid" >
                  <option v-for="item in classlist" value="@{{ item.value }}">@{{ item.text }}</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_type')}}</span>
                <select class="form-control" v-model="params_data.type">
                  <option v-for="item in modellist" value="@{{ item.value }}">@{{ item.text }}</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_name')}}</span>
                <input type="text" class="form-control" v-model="params_data.name"   >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_keyword')}}</span>
                <input type="text" class="form-control" v-model="params_data.keyword"   >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_ico')}}</span>
                <input type="text" class="form-control" v-model="params_data.ico"   >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_linkurl')}}</span>
                <input type="text" class="form-control" v-model="params_data.linkurl"   >
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon minwidth">{{trans('admin.fieldname_item_orderid')}}</span>
                <input type="text" class="form-control" v-model="params_data.orderid"   >
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

  <!--图标代码-->
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
       <div class="box-body">
        <center>  <img src="/images/emjoi.png" ></center>
       </div>
     </div>     
    </div>
  </div>    
  
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
       <div class="box-body"> 
        <div class="table-responsive">
            <table class="table no-margin">
              <thead>
                  <tr>
                      <th>图标</th>
                      <th>代码</th>
                      <th>图标</th>
                      <th>代码</th>
                      <th>图标</th>
                      <th>代码</th>
                      <th>图标</th>
                      <th>代码</th>
                      <th>图标</th>
                      <th>代码</th>
                  </tr>
              </thead>
              <tr>
                  <td width="10%">⇠ </td>
                  <td width="10%">8672 21E0</td> 
                  <td width="10%">⇢</td>
                  <td width="10%">8674 21E2</td>
                  <td width="10%">⇡</td>
                  <td width="10%">8673 21E1</td>
                  <td width="10%">⇣</td>
                  <td width="10%">8675 21E3</td>
                  <td width="10%">↞</td>
                  <td width="10%">8606 219E</td>
              </tr>
              <tr>
                  <td width="10%">↠</td>
                  <td width="10%">8608 21A0</td> 
                  <td width="10%">↟</td>
                  <td width="10%">8607 219F</td>
                  <td width="10%">↡</td>
                  <td width="10%">8609 21A1</td>
                  <td width="10%">⇦</td>
                  <td width="10%">8678 21E6</td>
                  <td width="10%">⇨</td>
                  <td width="10%">8680 21E8</td>
              </tr>
              <tr>
                  <td width="10%">▲</td>
                  <td width="10%">9650 25B2</td> 
                  <td width="10%">►</td>
                  <td width="10%">9658 25BA</td>
                  <td width="10%">▼</td>
                  <td width="10%">9660 25BC</td>
                  <td width="10%">◄</td>
                  <td width="10%">9668 25C4</td>
                  <td width="10%">❤</td>
                  <td width="10%">10084 2764</td>
              </tr>
              <tr>
                  <td width="10%">✈</td>
                  <td width="10%">9992 2708</td> 
                  <td width="10%">★</td>
                  <td width="10%">9733 2605</td>
                  <td width="10%">✦</td>
                  <td width="10%">10022 2726</td>
                  <td width="10%">☀</td>
                  <td width="10%">9728 2600</td>
                  <td width="10%">◆</td>
                  <td width="10%">9670 25C6</td>
              </tr>
              <tr>
                  <td width="10%">♪</td>
                  <td width="10%">9834 266A</td> 
                  <td width="10%">♫</td>
                  <td width="10%">9835 266B</td>
                  <td width="10%">✔</td>
                  <td width="10%">10004 2714</td>
                  <td width="10%">✖</td>
                  <td width="10%">10006 2716</td>
                  <td width="10%">✞</td>
                  <td width="10%">10014 271E</td>
              </tr>
              <tr>
                  <td width="10%">✚</td>
                  <td width="10%">10010 271A</td> 
                  <td width="10%">★</td>
                  <td width="10%">9733 2605</td>
                  <td width="10%">☆</td>
                  <td width="10%">9734 2606</td>
                  <td width="10%">✪</td>
                  <td width="10%">10026 272A</td>
                  <td width="10%">☻</td>
                  <td width="10%">9787 263B</td>
              </tr>
              <tr>
                  <td width="10%">☺</td>
                  <td width="10%">9786 263A</td> 
                  <td width="10%">☎</td>
                  <td width="10%">9742 260E</td>
                  <td width="10%">❄</td>
                  <td width="10%">10052 2744</td>
                  <td width="10%">☃</td>
                  <td width="10%">9731 2603</td>
                  <td width="10%">✿</td>
                  <td width="10%">10047 273F</td>
              </tr>
              <tr>
                  <td width="10%">❦</td>
                  <td width="10%">10086 2766</td> 
                  <td width="10%">✄</td>
                  <td width="10%">9988 2704</td>
                  <td width="10%">☢</td>
                  <td width="10%">9762 2622</td>
                  <td width="10%">☜</td>
                  <td width="10%">9756 261C</td>
                  <td width="10%">☞</td>
                  <td width="10%">9758 261E</td>
              </tr>
              <tr>
                  <td width="10%">☝</td>
                  <td width="10%">9757 261D</td> 
                  <td width="10%">☟</td>
                  <td width="10%">9759 261F</td>
                  <td width="10%">✍</td>
                  <td width="10%">9997 270D</td>
                  <td width="10%">✎</td>
                  <td width="10%">9998 270E</td>
                  <td width="10%">✏</td>
                  <td width="10%">9999 270F</td>
              </tr>
              <tr>
                  <td width="10%">♂</td>
                  <td width="10%">9794 2642</td> 
                  <td width="10%">♀</td>
                  <td width="10%">9792 2640</td>
                  <td width="10%">☿</td>
                  <td width="10%">9791 263F</td>
                  <td width="10%">♁</td>
                  <td width="10%">9793 2641</td>
                  <td width="10%">♠</td>
                  <td width="10%">9824 2660</td>
              </tr>
              <tr>
                  <td width="10%">♣</td>
                  <td width="10%">9827 2663</td> 
                  <td width="10%">♥</td>
                  <td width="10%">9829 2665</td>
                  <td width="10%">♡</td>
                  <td width="10%"></td>
                  <td width="10%"></td>
                  <td width="10%"></td>
                  <td width="10%"></td>
                  <td width="10%"></td>
              </tr>
          </table>
        </div>
       </div>
     </div>     
    </div>
  </div> 


</section>
<!-- /.content -->

<script type="text/javascript">
new Vue({
    el: '#app-content',
    data: {
             apiurl_add:            '{{ route("post.admin.classifywechat.api_add") }}', 
             apiurl_info:           '{{ route("post.admin.classifywechat.api_info") }}', 
             apiurl_edit:           '{{ route("post.admin.classifywechat.api_edit") }}',
             apiurl_del_image:      '{{ route("post.admin.deleteapi.api_del_image") }}',
             classlist:             eval(htmlspecialchars_decode('{{$website["classlist"]}}')), 
             modellist:             eval(htmlspecialchars_decode('{{$website["modellist"]}}')), 
             params_data:
             {
                wechat_id           :'{{$website["wechat_id"]}}',
                type                :'click',
                topid               :0,
                name                :'',
                keyword             :'',
                ico                 :'',
                linkurl             :'',
                orderid             :0,
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
      //点击数据验证
      check_action:function(posturl)
      {
          if (this.params_data.name=='')
          {
              var msg="{{trans('admin.option_failure_isclassname')}}";
              layermsg_error(msg);
          }
          else if (this.params_data.keyword=='')
          {
              var msg="{{trans('admin.option_failure_iskeyword')}}";
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