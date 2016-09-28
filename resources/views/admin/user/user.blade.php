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
            <li><a href="javascript:void(0);" @click="btnClick(per_page)" >@{{ per_page_title }}</a></li>
            <li><a href="javascript:void(0);"  >@{{ prev_page }}</a></li>
            <li v-for="index in totals"  v-bind:class="{ 'active': current_page == index+1}">
                <a href="javascript:void(0);" @click="btnClick(index+1)" >@{{ index+1 }} </a>
            </li>
            <li><a href="@{{ next_page_url }}">@{{ next_page }}</a></li>
            <li><a href="javascript:void(0);" @click="btnClick(last_page)" >@{{ last_page_title }}</a></li>
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
             totals         :     0,
             totals_title   :     '总记录数 0 条',  
             per_page_title :     '首页',
             per_page :           1,
             last_page_title:     '尾页',
             last_page:           1,
             prev_page:           "上一页", 
             current_page:        1,
             current_page_url:    'javascript:void(0);',
             next_page:           "下一页",
             prev_page_url:       'javascript:void(0);',
             next_page_url:       'javascript:void(0);',
             datalist :           [],
             apiUrl   :           '/admin/user/api_user_list',
             paramdata:           
             {
                    page   :        1,
                    way    :        'nick',
                    keyword:        '',
                    
             },
          },
    ready: function (){ 
            //这里是vue初始化完成后执行的函数 
            this.$http.post(this.apiUrl,this.paramdata,{
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
                /*
                if(data != this.current_page)
                {
                    this.current_page = data ;
                }
                */
                this.paramdata.page=data;

                this.$http.post(this.apiUrl,this.paramdata,{
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
            //处理列表数据
            do_list_action:function(response)
            {
                //响应成功
                layer.close(loadi);
                var statusinfo=response.data;
                //console.log(statusinfo);
                if(statusinfo.status==1)
                {
                    if(statusinfo.keyword)
                    {
                      this.paramdata.way=statusinfo.way;
                      this.paramdata.keyword=statusinfo.keyword;
                    }
                    //渲染数据列表
                    this.current_page=statusinfo.resource.current_page;
                    this.datalist=statusinfo.resource.data;
                    this.totals_title='总记录数 '+statusinfo.resource.total+' 条';
                    this.totals=statusinfo.resource.total;
                    this.per_page=statusinfo.resource.per_page;
                    this.last_page=statusinfo.resource.last_page;
                    //渲染分页
                    //layermsg_success(statusinfo.info);
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