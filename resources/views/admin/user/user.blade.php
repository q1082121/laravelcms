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
                <td>@{{ item.lock }}</td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <li><a href="#">&laquo;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">&raquo;</a></li>
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
             datalist :   [],
             apiUrl   :   '/admin/user/api_user_list'
          },
    ready: function (){ 
            //这里是vue初始化完成后执行的函数 
            this.$http.post(this.apiUrl,{
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
                console.log(statusinfo);
                if(statusinfo.status==1)
                {
                    this.datalist=statusinfo.resource;
                    //layermsg_success(statusinfo.info);
                }
                else
                {
                    layermsg_error(statusinfo.info);
                }
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
})

</script>
@endsection