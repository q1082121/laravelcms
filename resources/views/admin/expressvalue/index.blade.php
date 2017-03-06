@extends('layouts.admin_iframe')
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
            <button type="button" class="btn btn-default pull-left " style="margin:0 0 0 10px;">
              【{{trans('admin.website_navigation_expresstemplate')}}： {{$website['info']['name']}}】
            </button>
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
              <th>{{trans('admin.fieldname_item_price')}}</th>
              <th>{{trans('admin.fieldname_item_area_items')}}</th>
              <th>{{trans('admin.fieldname_item_status')}}</th>
              <th>{{trans('admin.fieldname_item_option')}}</th>
            </tr>
            </thead>
            <tbody>
              @include('admin.include.fieldvalue.v-for')
                <td>@{{ item.id }}</td>
                <td>@{{ item.name }}</td>
                <td>@{{ item.price }}</td>
                <td>@{{ item.arealist }}</td>
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
             apiurl_list          :'{{ route("post.admin.expressvalue.api_list") }}',
             linkurl_add          :'{{ route("get.admin.expressvalue.add") }}/{{$website["expresstemplate_id"]}}',
             linkurl_edit         :'{{ route("get.admin.expressvalue.edit") }}/',
             @include('admin.include.vue-apiurl-action-one')
             @include('admin.include.vue-apiurl-action-delete')
             @include('admin.include.vue-pages-dataitems')
             @include('admin.include.vue-pages-pageparams-expresstemplate')
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
            @include('admin.include.vue-methods-link_click_delete')
        }            
})

</script>
@endsection