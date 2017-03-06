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
            <button type="button" @click="back_action()" class="btn btn-primary" > <i class="fa fa-reply"></i> {{trans('admin.website_navigation_user')}}</button>
            <button type="button" class="btn btn-primary" > <i class="fa fa-bookmark"></i> {{$website['info']['nick']}} </button>
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
                    @ability('admin', 'get_user_role')
                    <button v-if="item.user_id != paramsdata.id " @click="get_action(item.id)" type="button"  class="btn btn-success" > <i class="fa fa-bookmark"></i> {{trans('admin.website_action_get_role')}}</button>
                    @endability
                    @ability('admin', 'cancel_user_role')
                    <button v-else type="button"  class="btn btn-danger" @click="cancel_action(item.id)" > <i class="fa fa-bookmark-o"></i> {{trans('admin.website_action_cancel_role')}}</button>
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
             apiurl_list:         '{{ route("post.admin.userrole.api_list_related") }}', 
             apiurl_get:          '{{ route("post.admin.userrole.api_get_role") }}',
             apiurl_cancel:       '{{ route("post.admin.userrole.api_cancel_role") }}',
             @include('admin.include.vue-pages-dataitems')
             @include('admin.include.vue-pages-pageparams-user')
             @include('admin.include.vue-pages-paramsdata-user')
             
          },
    @include('admin.include.vue-ready')
    @include('admin.include.vue-pages-computed')
    methods: {
            @include('admin.include.vue-methods-action_list_get')
            @include('admin.include.vue-methods-action_list_do')
            @include('admin.include.vue-methods-action_list_search')
            @include('admin.include.vue-methods-link_click_page')
            @include('admin.include.vue-methods-link_click_back')
            @include('admin.include.vue-methods-action_info_return')
            //点击获取权限
            get_action:function(data)
            {
              this.paramsdata.role_id=data;
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
              this.paramsdata.role_id=data;
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