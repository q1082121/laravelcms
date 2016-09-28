@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
  <!-- row -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box" id="app-content">
        <div class="box-header">
          <h3 class="box-title">{{trans('admin.website_user_module_list')}}</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" >
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>{{trans('admin.website_user_item_id')}}</th>
              <th>{{trans('admin.website_user_item_username')}}</th>
              <th>{{trans('admin.website_user_item_email')}}</th>
              <th>{{trans('admin.website_user_item_mobile')}}</th>
              <th>{{trans('admin.website_user_item_group')}}</th>
              <th>{{trans('admin.website_user_item_nick')}}</th>
              <th>{{trans('admin.website_user_item_money')}}</th>
              <th>{{trans('admin.website_user_item_score')}}</th>
              <th>{{trans('admin.website_user_item_lock')}}</th>
              <th>{{trans('admin.website_item_option')}}</th>
            </tr>
            </thead>
            <tbody>
              <tr v-for="item in datalist">
                <td>@{{ item.id }}</td>
                <td>@{{ item.username }}</td>
                <td>@{{ item.email }}</td>
                <td>@{{ item.mobile }}</td>
                <td>@{{ item.group }}</td>
                <td>@{{ item.nick }}</td>
                <td>@{{ item.money }}</td>
                <td>@{{ item.score }}</td>
                <td>@{{ item.is_lock }}</td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <li><a href="javascript:void(0);">@{{ totals_title }}</a></li>
            <li><a href="javascript:void(0);" @click="btnClick(per_page)" >{{trans('admin.website_per_page_title')}}</a></li>
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
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name=csrf-token]').getAttribute('content')
Vue.http.options.emulateJSON = true;

new Vue({
    el: '#app-content',
    data: {
             totals               : 0,
             totals_title         :"{{trans('admin.website_page_total')}}",  
             per_page             :1,//首页
             prev_page            :1,//上一页
             current_page         :1,//当前页
             next_page            :1,//下一页
             last_page            :1,//尾页
             datalist :           [],
             apiUrl   :           '/admin/user/api_user_list',
             pageparams:           
             {
                    page   :        1,
                    way    :        'nick',
                    keyword:        '',
                    
             },
          },
    ready: function (){ 
            //这里是vue初始化完成后执行的函数 
            this.$http.post(this.apiUrl,this.pageparams,{
              before:function(request)
              {
                loadi=layer.load("检测中...");
              },
            })
            .then((response) => 
              {
                this.do_list_action(response);
              },(response) => 
              {
                //响应错误
                var msg="{{trans('admin.website_outtime')}}";
                layermsg_error(msg);
              })
              .catch(function(response) {
                //异常抛出
                var msg="{{trans('admin.website_outtime_error')}}";
                layermsg_error(msg);
              })
            },
    methods: {
            btnClick: function(data)
            {   //页码点击事件
                /**/
                if(data != this.current_page)
                {
                   // this.current_page = data ;
                   this.pageparams.page=data;
                   this.$http.post(this.apiUrl,this.pageparams,{
                      before:function(request)
                      {
                        loadi=layer.load("检测中...");
                      },
                    })
                    .then((response) => 
                      {
                        this.do_list_action(response);
                      },(response) => 
                      {
                        //响应错误
                        var msg="{{trans('admin.website_outtime')}}";
                        layermsg_error(msg);
                      })
                      .catch(function(response) {
                        //异常抛出
                        var msg="{{trans('admin.website_outtime_error')}}";
                        layermsg_error(msg);
                      })
                }
            },
            //处理列表数据
            do_list_action:function(response)
            {
                //响应成功
                layer.close(loadi);
                var statusinfo=response.data;
                //console.log(statusinfo);
                if(statusinfo.status==1)
                {
                    //查询条件数据
                    if(statusinfo.keyword)
                    {
                      this.pageparams.way=statusinfo.way;
                      this.pageparams.keyword=statusinfo.keyword;
                    }
                    //分页参数赋值
                    this.current_page=statusinfo.resource.current_page;//当前页数据
                    this.totals_title='总记录数 '+statusinfo.resource.total+' 条';//总记页数标题
                    this.totals=statusinfo.resource.total;//总记录页数
                    this.per_page=statusinfo.resource.per_page;//首页数据
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
                    //渲染列表数据
                    this.datalist=statusinfo.resource.data;
                }
                else
                {
                    layermsg_error(statusinfo.info);
                }
            }
        }            
})

</script>
@endsection