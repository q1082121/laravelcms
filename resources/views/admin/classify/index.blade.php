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
            @include('admin.include.button-cache')
          </h3>
          @include('admin.include.search')
        </div>
        <!-- /.box-header -->
        <div class="box-body" >
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>{{trans('admin.fieldname_item_id')}}</th>
              <th>{{trans('admin.fieldname_item_name')}}</th>
              <th>{{trans('admin.fieldname_item_attachment')}}</th>
              <th>{{trans('admin.fieldname_item_bcid')}}</th>
              <th>{{trans('admin.fieldname_item_scid')}}</th>
              <th>{{trans('admin.fieldname_item_navflag')}}</th>
              <th>{{trans('admin.fieldname_item_perpageorlist')}}</th>
              <th>{{trans('admin.fieldname_item_orderid')}}</th>
              <th>{{trans('admin.fieldname_item_status')}}</th>
              <th>{{trans('admin.fieldname_item_option')}}</th>
            </tr>
            </thead>
            <tbody>
              @include('admin.include.fieldvalue.v-for')
                <td>@{{ item.id }}</td>
                <td>@{{ item.gtstr }} @{{ item.name }}</td>
                @include('admin.include.fieldvalue.attachment')
                <td>@{{ item.bcid }}</td>
                <td>@{{ item.scid }}</td>
                <td> <i v-if="item.navflag == 1" class="fa fa-star"></i> <i v-else class="fa fa-star-o"></i> </td>
                <td> <i v-if="item.perpage == 1" class="fa fa-file-text"> 单 </i> <i v-else class="fa fa-list"> 列 </i> </td>
                <td>@{{ item.orderid }}</td>
                @include('admin.include.fieldvalue.status')
                <td>
                  <div class="tools">
                    @include('admin.include.fieldvalue.option')
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
             apiurl_list          :'{{ route("post.admin.classify.api_list") }}',
             linkurl_add          :'{{ route("get.admin.classify.add") }}',
             linkurl_edit         :'{{ route("get.admin.classify.edit") }}/', 
             @include('admin.include.vue-apiurl-action-one')
             @include('admin.include.vue-apiurl-action-delete')
             @include('admin.include.vue-apiurl-action-cache')
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
            @include('admin.include.vue-methods-action_cache_create')
            @include('admin.include.vue-methods-link_click_add')
            @include('admin.include.vue-methods-link_click_edit')
            @include('admin.include.vue-methods-link_click_page')
            @include('admin.include.vue-methods-link_click_delete')
        }            
})

</script>
@endsection