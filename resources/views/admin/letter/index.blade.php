@extends('layouts.admin')
@section('content')

<!-- Main content -->
<section class="content">
  <div class="row" id="app-content">
    <div class="col-md-3">
    <a href="{{ route('get.admin.letter.add') }}" class="btn btn-primary btn-block margin-bottom">{{trans('admin.website_action_add')}}</a>
    @include('admin.letter.nav')
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$website['cursitename']}}</h3>

          <div class="box-tools pull-right">
            @ability('admin', 'search')
            <div style="position: absolute;right:170px;top:0;width: 120px;">
            <select  v-model="pageparams.way" style="width: 100%;height:30px;line-height:30px;padding:1% 3%;">
              <option v-for="item in pageparams.wayoption" value="@{{ item.value }}">@{{ item.text }}</option>
            </select>
            </div>
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" autocomplete="off" class="form-control pull-right" placeholder="Search" v-model="pageparams.keyword" value="@{{ pageparams.keyword }}">
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default" @click="search_list_action()" ><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
            @endability
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <thead>
              <tr>
                <th>{{trans('admin.fieldname_item_id')}}</th>
                <th>{{trans('admin.fieldname_item_isstar')}}</th>
                <th>{{trans('admin.fieldname_item_title')}}</th>
                <th>{{trans('admin.fieldname_item_to_user')}}</th>
                <th>{{trans('admin.fieldname_item_created_at')}}</th>
                <th>{{trans('admin.fieldname_item_option')}}</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="item in datalist" >
                <td class="mailbox-id">@{{ item.id }}</td>
                <td class="mailbox-star" v-if="item.isstar_from == 1 && item.email_from == email " ><a href="javascript:void(0);" @click="get_one_action(item.id,'isstar_from')" ><i class="fa fa-star text-yellow"></i></a></td>
                <td class="mailbox-star" v-if="item.isstar_from == 0 && item.email_from == email " ><a href="javascript:void(0);" @click="get_one_action(item.id,'isstar_from')"><i class="fa fa-star-o text-yellow"></i></a></td>
                <td class="mailbox-star" v-if="item.isstar_to == 1 && item.email_to == email " ><a href="javascript:void(0);" @click="get_one_action(item.id,'isstar_to')" ><i class="fa fa-star text-yellow"></i></a></td>
                <td class="mailbox-star" v-if="item.isstar_to == 0 && item.email_to == email " ><a href="javascript:void(0);" @click="get_one_action(item.id,'isstar_to')"><i class="fa fa-star-o text-yellow"></i></a></td>
                <td class="mailbox-subject"><b>@{{ item.title }}</b></td>
                <td class="mailbox-attachment">@{{ item.email_to }}</td>
                <td class="mailbox-date">@{{ item.created_at }}</td>
                @if(getCurrentMethodName()=='index')
                <td>
                  <div class="tools">
                    <button v-if="actionname =='index' && item.istrash_to == 0 && item.isdel_to == 0 "  type="button" @click="get_one_action(item.id,'istrash_to')"  class="btn btn-primary" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_trash')}}</button>
                  </div>
                </td>
                @endif
                @if(getCurrentMethodName()=='send')
                <td>
                  <div class="tools">
                    <button v-if="actionname =='send' && item.istrash_from == 0 && item.isdel_from == 0 "  type="button" @click="get_one_action(item.id,'istrash_from')"  class="btn btn-primary" > <i class="fa fa-toggle-off"></i> {{trans('admin.website_action_trash')}}</button>
                  </div>
                </td>
                @endif
                @if(getCurrentMethodName()=='star')
                <td>
                  <div class="tools">
                    <button v-if="actionname =='star' && item.istrash_from == 0  && item.isdel_from == 0 && item.email_from == email"  type="button" @click="get_one_action(item.id,'istrash_from')"  class="btn btn-primary" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_trash')}}</button>
                    <button v-if="actionname =='star' && item.istrash_to == 0 && item.isdel_to == 0 && item.email_to == email"  type="button" @click="get_one_action(item.id,'istrash_to')"  class="btn btn-primary" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_trash')}}</button>
                  </div>
                </td>
                @endif
                @if(getCurrentMethodName()=='trash')
                <td>
                  <div class="tools">
                    <button v-if="actionname =='trash' && item.istrash_from == 1  && item.isdel_from == 0 && item.email_from == email"  type="button" @click="get_one_action(item.id,'istrash_from')"  class="btn btn-danger" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_back')}}</button>
                    <button v-if="actionname =='trash' && item.istrash_to == 1 && item.isdel_to == 0 && item.email_to == email"  type="button" @click="get_one_action(item.id,'istrash_to')"  class="btn btn-danger" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_back')}}</button>
                    @ability('admin', 'delete')
                    <button v-if="actionname =='trash' && item.istrash_from == 1 && item.isdel_from == 0 " type="button" @click="get_one_action(item.id,'isdel_from')" class="btn btn-danger" > <i class="fa fa-trash"></i> {{trans('admin.website_action_delete')}}</button>
                    <button v-if="actionname =='trash' && item.istrash_to == 1 && item.isdel_to == 0 " type="button" @click="get_one_action(item.id,'isdel_to')" class="btn btn-danger" > <i class="fa fa-trash"></i> {{trans('admin.website_action_delete')}}</button>
                    @endability
                  </div>
                </td>
                @endif
              </tr>
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <li><a href="javascript:void(0);">@{{ totals_title }}</a></li>
            <li><a href="javascript:void(0);" @click="btnClick(first_page)" >{{trans('admin.website_first_page_title')}}</a></li>
            <li><a href="javascript:void(0);" @click="btnClick(prev_page)" >{{trans('admin.website_prev_page_title')}}</a></li>
            <li v-for="index in totals"  v-bind:class="{ 'active': current_page == index+1}">
                <a href="javascript:void(0);" @click="btnClick(index+1)" >@{{ index+1 }} </a>
            </li>
            <li><a href="javascript:void(0);" @click="btnClick(next_page)" >{{trans('admin.website_next_page_title')}}</a></li>
            <li><a href="javascript:void(0);" @click="btnClick(last_page)" >{{trans('admin.website_last_page_title')}}</a></li>
          </ul>
        </div>
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
             apiurl_list          :'{{ route("post.admin.letter.api_list") }}',
             apiurl_one_action    :'{{ route("post.admin.oneactionapi.api_one_action") }}',
             apiurl_delete        :'{{ route("post.admin.deleteapi.api_delete") }}',
             apiurl_count         :'{{ route("post.admin.letter.api_count") }}',
             email                :'{{$website["website_user"]["email"]}}' ,
             actionname           :'{{getCurrentMethodName()}}',
             totals               : 0,
             totals_title         :"{{trans('admin.website_page_total')}}",  
             first_page           :1,//首页
             prev_page            :1,//上一页
             current_page         :1,//当前页
             next_page            :1,//下一页
             last_page            :1,//尾页
             datalist :           [],//列表数据
             pageparams:           
             {
                    page           :1,
                    way            :'{{$website["way"]}}',
                    wayoption      :eval(htmlspecialchars_decode('{{$website["wayoption"]}}')),
                    keyword        :'',
                    actionname     :'', 
             },
             paramsdata:
             {
                    id             :'',
                    fields         :'',
                    modelname      :'{{getCurrentControllerName()}}',
             },
             countdata:
             {
                    count_index    :0,
                    count_send     :0,
                    count_star     :0,
                    count_trash    :0,
             }
             
          },
    ready: function ()
            { 
            this.pageparams.actionname=this.actionname;  
            //这里是vue初始化完成后执行的函数 
            this.get_list_action();
            },
    methods: {
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
            get_list_action:function()
            {

              this.$http.post(this.apiurl_list,this.pageparams,{
                before:function(request)
                {
                  loadi=layer.load("...");
                },
              })
              .then((response) => 
              {
                this.do_list_action(response);
                this.get_count_action();
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
            //处理列表数据
            do_list_action:function(response)
            {
                this.datalist=[];
                //响应成功
                layer.close(loadi);
                var statusinfo=response.data;
                //console.log(statusinfo);
                if(statusinfo.status==1)
                {
                    /*
                     |---------------------------------------------
                     | 查询条件数据赋值
                     |---------------------------------------------
                     |
                     */
                    if(statusinfo.keyword)
                    {
                      this.pageparams.way=statusinfo.way;
                      this.pageparams.keyword=statusinfo.keyword;
                    }
                    /*
                     |---------------------------------------------
                     | 分页参数赋值
                     |---------------------------------------------
                     |
                     */
                    this.current_page=statusinfo.resource.current_page;//当前页数据
                    this.totals_title=statusinfo.resource.total+' {{trans('admin.website_page_total_tip')}}';//总记页数标题
                    this.totals=Math.ceil(statusinfo.resource.total/statusinfo.resource.per_page);//总记录页数
                    this.last_page=statusinfo.resource.last_page;//尾页数据
                    //下一页数据
                    if(this.current_page==this.totals)
                    {
                      this.next_page=this.totals;
                    }
                    else
                    {
                      this.next_page=this.current_page+1;
                    }
                    //上一页数据
                    if(this.current_page==1)
                    {
                      this.prev_page=1;
                    }
                    else
                    {
                      this.prev_page=this.current_page-1;
                    }
                    /*
                     |---------------------------------------------
                     | 渲染列表数据
                     |---------------------------------------------
                     |
                     */
                    this.datalist=statusinfo.resource.data;
                }
                else
                {
                    layermsg_error(statusinfo.info);
                }
            },
            //点击搜索获取列表数据
            search_list_action:function()
            {
              this.get_list_action();
            },
            //点击页码获取列表数据
            btnClick: function(data)
            {   
                if(data != this.current_page)
                {
                   // this.current_page = data ;
                   this.pageparams.page=data;
                   this.get_list_action();
                }
            },
            //点击获取一键操作
            get_one_action:function(data,fields)
            {
              this.paramsdata.id=data;
              this.paramsdata.fields=fields;
              this.$http.post(this.apiurl_one_action,this.paramsdata,{
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
                      this.get_list_action();
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

        }            
})

</script>
@endsection