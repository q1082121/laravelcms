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
          @include('admin.include.search')
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
              @include('admin.include.fieldvalue.v-for')
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
        @include('admin.include.pages')
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
    @include('admin.include.vue-el')
    data: {
             apiurl_list          :'{{ route("post.admin.user.api_list") }}', 
             linkurl_set          :'{{ route("get.admin.user.set") }}/',  
             @include('admin.include.vue-apiurl-action-one')
             @include('admin.include.vue-pages-dataitems')
             @include('admin.include.vue-pages-pageparams')
             @include('admin.include.vue-pages-paramsdata')
          },
    @include('admin.include.vue-ready')
    @include('admin.include.vue-pages-computed')
    methods: {
            @include('admin.include.vue-methods-action_list_get')
            @include('admin.include.vue-methods-action_list_do')
            @include('admin.include.vue-methods-action_list_search')
            @include('admin.include.vue-methods-action_one_get')
            @include('admin.include.vue-methods-action_info_return')
            @include('admin.include.vue-methods-link_click_add')
            @include('admin.include.vue-methods-link_click_page')
            //设置操作跳转
            set_action:function(data)
            {
              window.location.href=this.linkurl_set+data;
            },
        }            
})

</script>
@endsection