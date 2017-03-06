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
              <th>{{trans('admin.fieldname_item_name')}}</th>
              <th>{{trans('admin.fieldname_item_isdefault')}}</th>
              <th>{{trans('admin.fieldname_item_ispostage')}}</th>
              <th>{{trans('admin.fieldname_item_price_postage')}}</th>
              <th>{{trans('admin.fieldname_item_isexpress')}}</th>
              <th>{{trans('admin.fieldname_item_price_express')}}</th>
              <th>{{trans('admin.fieldname_item_isems')}}</th>
              <th>{{trans('admin.fieldname_item_price_ems')}}</th>
              <th>{{trans('admin.fieldname_item_option')}}</th>
            </tr>
            </thead>
            <tbody>
              @include('admin.include.fieldvalue.v-for')
                <td>@{{ item.id }}</td>
                <td>@{{ item.name }}</td>
                <td><i v-if="item.isdefault == 0"  class="fa fa-toggle-off"> {{trans('admin.website_status_off')}} </i> <i v-if="item.isdefault == 1"  class="fa fa-toggle-on"> {{trans('admin.website_status_on')}} </i></td>
                <td><i v-if="item.ispostage == 0"  class="fa fa-toggle-off"> {{trans('admin.website_status_off')}} </i> <i v-if="item.ispostage == 1"  class="fa fa-toggle-on"> {{trans('admin.website_status_on')}} </i></td>
                <td>@{{ item.price_postage }}</td>
                <td><i v-if="item.isexpress == 0"  class="fa fa-toggle-off"> {{trans('admin.website_status_off')}} </i> <i v-if="item.isexpress == 1"  class="fa fa-toggle-on"> {{trans('admin.website_status_on')}} </i></td>
                <td>@{{ item.price_express }}</td>
                <td><i v-if="item.isems == 0"  class="fa fa-toggle-off"> {{trans('admin.website_status_off')}} </i> <i v-if="item.isems == 1"  class="fa fa-toggle-on"> {{trans('admin.website_status_on')}} </i></td>
                <td>@{{ item.price_ems }}</td>
                <td>
                  <div class="tools">
                    <button type="button" @click="subval_action(item.id)" class="btn btn-warning" > <i class="fa fa-tags"></i> {{trans('admin.website_action_subexpress_items')}}</button>
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
             apiurl_list          :'{{ route("post.admin.expresstemplate.api_list") }}',
             linkurl_add          :'{{ route("get.admin.expresstemplate.add") }}',
             linkurl_edit         :'{{ route("get.admin.expresstemplate.edit") }}/',
             linkurl_subval       :'{{ route("get.admin.expressvalue") }}/',
             @include('admin.include.vue-apiurl-action-one')
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
            @include('admin.include.vue-methods-action_one_get')
            @include('admin.include.vue-methods-action_info_return')
            @include('admin.include.vue-methods-link_click_add')
            @include('admin.include.vue-methods-link_click_edit')
            @include('admin.include.vue-methods-link_click_page')
            @include('admin.include.vue-methods-link_click_delete')
            @include('admin.include.vue-methods-link_click_subval')
        }            
})

</script>
@endsection