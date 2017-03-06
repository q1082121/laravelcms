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
            @include('admin.include.button-add')
          </h3>
          @include('admin.include.search')
        </div>
        <!-- /.box-header -->
        <div class="box-body" >
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>{{trans('admin.fieldname_item_id')}}</th>
              <th>{{trans('admin.fieldname_item_type')}}</th>
              <th>{{trans('admin.fieldname_item_token')}}</th>
              <th>{{trans('admin.fieldname_item_name')}}</th>
              <th>{{trans('admin.fieldname_item_logo')}}</th>
              <th>{{trans('admin.fieldname_item_gid')}}</th>
              <th>{{trans('admin.fieldname_item_status')}}</th>
              <th>{{trans('admin.fieldname_item_option')}}</th>
            </tr>
            </thead>
            <tbody>
              @include('admin.include.fieldvalue.v-for')
                <td>@{{ item.id }}</td>
                <td v-if="item.type == 1"> <i class="fa fa-wechat"></i> {{trans('admin.define_model_wechat1')}}</td>
                <td v-if="item.type == 2"> <i class="fa fa-wechat"></i> {{trans('admin.define_model_wechat2')}}</td>
                <td v-if="item.type == 3"> <i class="fa fa-wechat"></i> {{trans('admin.define_model_wechat3')}}</td>
                <td v-if="item.type == 4"> <i class="fa fa-wechat"></i> {{trans('admin.define_model_wechat4')}}</td>
                <td v-if="item.type == 5"> <i class="fa fa-wechat"></i> {{trans('admin.define_model_wechat5')}}</td>
                <td>@{{ item.token }}</td>
                <td>@{{ item.name }}</td>
                <td><i v-if="item.isattach == 1" onclick="open_box_image('/uploads/{{getCurrentControllerName()}}/thumb/@{{item.attachment}}')" class="fa fa-file-picture-o"> 查看 </i> <i v-else class="fa fa-file-o" ></i></td>
                <td>@{{ item.gid }}</td>
                <td><i v-if="item.status == 0"  class="fa fa-toggle-off"> {{trans('admin.website_status_off')}} </i> <i v-if="item.status == 1"  class="fa fa-toggle-on"> {{trans('admin.website_status_on')}} </i></td>
                <td>
                  <div class="tools">
                    @ability('admin', 'edit')
                    <button type="button" @click="edit_action(item.id)" class="btn btn-primary" > <i class="fa fa-edit"></i> {{trans('admin.website_action_edit')}}</button>
                    @endability
                    @ability('admin', 'set_status')
                    <button v-if="item.status == 1"  type="button" @click="get_one_action(item.id,'status')"  class="btn btn-primary" > <i class="fa fa-toggle-off"></i> {{trans('admin.website_action_status')}}</button>
                    <button v-else  type="button" @click="get_one_action(item.id,'status')"  class="btn btn-danger" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_status')}}</button>
                    @endability
                    <button type="button" @click="link_manage_action(item.id)"  class="btn btn-danger" > <i class="fa fa-certificate"></i> {{trans('admin.website_navigation_management_center')}}</button>
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
             apiurl_list          :'{{ route("post.admin.wechat.api_list") }}',
             linkurl_add          :'{{ route("get.admin.wechat.add") }}',
             linkurl_edit         :'{{ route("get.admin.wechat.edit") }}/',
             linkurl_manage       :'{{ route("get.admin.wechat.manage") }}/',
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
            @include('admin.include.vue-methods-link_click_edit')
            @include('admin.include.vue-methods-link_click_page')
            link_manage_action:function(id)
            {
                window.location.href=this.linkurl_manage+id;
            },
        }            
})

</script>
@endsection