@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
  <!-- row -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box" id="app-content">
        <div class="box-header">
          <h3 class="box-title">
            <button type="button" @click="back_action()" class="btn btn-primary" > <i class="fa fa-reply"></i> {{trans('admin.website_navigation_role')}}</button>
            <button type="button" class="btn btn-primary" > <i class="fa fa-bookmark"></i> {{$website['info']['display_name']}} </button>
          </h3>
          @include('admin.include.search')
        </div>
        <!-- /.box-header -->
        <div class="box-body" >
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>{{trans('admin.fieldname_item_id')}}</th>
              <th>{{trans('admin.fieldname_item_keyval')}}</th>
              <th>{{trans('admin.fieldname_item_name')}}</th>
              <th>{{trans('admin.fieldname_item_description')}}</th>
              <th>{{trans('admin.fieldname_item_option')}}</th>
            </tr>
            </thead>
            <tbody>
              @include('admin.include.fieldvalue.v-for')
                <td>@{{ item.id }}</td>
                <td>@{{ item.name }}</td>
                <td>@{{ item.display_name }}</td>
                <td>@{{ item.description }}</td>
                <td>
                  <div class="tools">
                  @ability('admin', 'get_role_permission')
                    <button v-if="item.role_id != paramsdata.id " @click="get_action(item.id)" type="button"  class="btn btn-success" > <i class="fa fa-bookmark"></i> {{trans('admin.website_action_get_permission')}}</button>
                  @endability
                  @ability('admin', 'cancel_role_permission')
                    <button v-else type="button"  class="btn btn-danger" @click="cancel_action(item.id)" > <i class="fa fa-bookmark-o"></i> {{trans('admin.website_action_cancel_permission')}}</button>
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
             apiurl_list:         '{{ route("post.admin.userpermission.api_list_related") }}', 
             apiurl_get:          '{{ route("post.admin.userpermission.api_get_permission") }}', 
             apiurl_cancel:       '{{ route("post.admin.userpermission.api_cancel_permission") }}',
             @include('admin.include.vue-pages-dataitems')
             @include('admin.include.vue-pages-pageparams-userrole')
             @include('admin.include.vue-pages-paramsdata-userpermission')
          },
    @include('admin.include.vue-ready')
    @include('admin.include.vue-pages-computed')
    methods: {
            @include('admin.include.vue-methods-action_list_get')
            @include('admin.include.vue-methods-action_list_do')
            @include('admin.include.vue-methods-action_list_search')
            @include('admin.include.vue-methods-link_click_page')
            @include('admin.include.vue-methods-action_info_return')
            //点击返回
            back_action:function()
            {
              goback();
            },
            //点击获取权限
            get_action:function(data)
            {
              this.paramsdata.permission_id=data;
              this.$http.post(this.apiurl_get,this.paramsdata,{
                @include('admin.include.vue-http-before')
              })
              .then((response) => 
              {
                this.return_info_action(response);

              },@include('admin.include.vue-http-then-error'))
              @include('admin.include.vue-http-catch-error')
            },
             //点击取消权限
            cancel_action:function(data)
            {
              this.paramsdata.permission_id=data;
              this.$http.post(this.apiurl_cancel,this.paramsdata,{
                @include('admin.include.vue-http-before')
              })
              .then((response) => 
              {
                this.return_info_action(response);

              },@include('admin.include.vue-http-then-error'))
              @include('admin.include.vue-http-catch-error')
            }
        }            
})

</script>
@endsection