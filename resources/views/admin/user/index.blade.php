@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
  <!-- row -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box" id="app-content">
        <div class="box-header">
          <h3 class="box-title"></h3>

          @ability('admin', 'search')
          <div style="position: absolute;right:170px;top:5px;width: 120px;">
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
        <!-- /.box-header -->
        <div class="box-body" >
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>{{trans('admin.fieldname_item_id')}}</th>
              <th>{{trans('admin.fieldname_item_username')}}</th>
              <th>{{trans('admin.fieldname_item_email')}}</th>
              <th>{{trans('admin.fieldname_item_mobile')}}</th>
              <th>{{trans('admin.fieldname_item_group')}}</th>
              <th>{{trans('admin.fieldname_item_nick')}}</th>
              <th>{{trans('admin.fieldname_item_money')}}</th>
              <th>{{trans('admin.fieldname_item_score')}}</th>
              <th>{{trans('admin.fieldname_item_lock')}}</th>
              <th>{{trans('admin.fieldname_item_option')}}</th>
            </tr>
            </thead>
            <tbody>
              <tr v-for="item in datalist">
                <td>@{{ item.user_id }}</td>
                <td>@{{ item.username }}</td>
                <td>@{{ item.email }}</td>
                <td>@{{ item.mobile }}</td>
                <td>@{{ item.group }}</td>
                <td>@{{ item.nick }}</td>
                <td>@{{ item.money }}</td>
                <td>@{{ item.score }}</td>
                <td><i v-if="item.is_lock == 1"  class="fa fa-lock"></i> <i v-if="item.is_lock == 0"  class="fa fa-unlock"></i></td>
                <td>
                  <div class="tools">
                    @ability('admin', 'set_role')
                    <button type="button" @click="set_action(item.user_id)" class="btn btn-primary" > <i class="fa fa-magic"></i> {{trans('admin.website_action_set_role')}}</button>
                    @endability
                    @ability('admin', 'set_lock')
                    <button v-if="item.user_id != 1 && item.is_lock == 0 " @click="get_one_action(item.user_id,'is_lock')" type="button"  class="btn btn-primary" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_lock')}}</button>
                    <button v-if="item.user_id != 1 && item.is_lock == 1 " @click="get_one_action(item.user_id,'is_lock')" type="button"  class="btn btn-danger" > <i class="fa fa-toggle-off"></i> {{trans('admin.website_action_lock')}}</button>
                    @endability
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
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
        <!-- /.page -->
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
             apiurl_list          :'{{ route("post.admin.user.api_list") }}', 
             apiurl_delete        :'{{ route("post.admin.deleteapi.api_delete") }}',
             linkurl_set          :'{{ route("get.admin.user.set") }}/',  
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
             },
             paramsdata:
             {
                    id             :'',
                    fields         :'',
                    modelname      :'{{getCurrentControllerName()}}',
             }
          },
    ready: function (){ 
            //这里是vue初始化完成后执行的函数 
            this.get_list_action();
            },
    methods: {
            //获取列表数据
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
            //点击跳转编辑
            link_action:function(data)
            {
                
            },
            //设置操作跳转
            set_action:function(data)
            {
              window.location.href=this.linkurl_set+data;
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