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
            <button type="button" class="btn btn-warning pull-left " @click="clear_action()">
              <i class="fa fa-trash"></i> {{trans('admin.website_action_clear_data')}} 
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
              <th>{{trans('admin.fieldname_item_type')}}</th>
              <th>{{trans('admin.fieldname_item_name')}}</th>
              <th>{{trans('admin.fieldname_item_info')}}</th>
              <th>{{trans('admin.fieldname_item_ip')}}</th>
              <th>{{trans('admin.fieldname_item_created_at')}}</th>
              <th>{{trans('admin.fieldname_item_option')}}</th>
            </tr>
            </thead>
            <tbody>
              @include('admin.include.fieldvalue.v-for')
                <td>@{{ item.id }}</td>
                <td v-if="item.type == 1"> <i class="fa fa-leanpub"></i> {{trans('admin.define_model_log1')}}</td>
                <td>@{{ item.name }}</td>
                <td>@{{ item.info }}</td>
                <td>@{{ item.ip }}</td>
                <td>@{{ item.created_at }}</td>
                <td>
                  <div class="tools">
                    @ability('admin', 'delete')
                    <button type="button" @click="delete_action(item.id)" class="btn btn-danger" > <i class="fa fa-trash"></i> {{trans('admin.website_action_delete')}}</button>
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
             apiurl_list          :'{{ route("post.admin.log.api_list") }}',
             @include('admin.include.vue-apiurl-action-clear')
             @include('admin.include.vue-apiurl-action-delete')
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
            @include('admin.include.vue-methods-action_info_return')
            @include('admin.include.vue-methods-link_click_page')
            @include('admin.include.vue-methods-link_click_delete') 
        }            
})

</script>
@endsection