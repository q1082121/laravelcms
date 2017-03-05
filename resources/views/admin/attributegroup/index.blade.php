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
              @include('admin.include.fieldname.id')
              @include('admin.include.fieldname.keyval')
              @include('admin.include.fieldname.name')
              @include('admin.include.fieldname.type')
              <th>{{trans('admin.fieldname_item_displaytype')}}</th>
              <th>{{trans('admin.fieldname_item_class')}}</th>
              @include('admin.include.fieldname.orderid')
              @include('admin.include.fieldname.status')
              @include('admin.include.fieldname.option')
            </tr>
            </thead>
            <tbody>
              @include('admin.include.fieldvalue.v-for')
                @include('admin.include.fieldvalue.id')
                <td>@{{ item.name }}</td>
                <td>@{{ item.display_name }}</td>
                <td v-if="item.type == 'text'"> <i class="fa fa-leaf"></i> {{trans('admin.fieldname_item_type_text')}}</td>
                <td v-if="item.type == 'checkbox'"> <i class="fa fa-leaf"></i> {{trans('admin.fieldname_item_type_checkbox')}}</td>
                <td v-if="item.type == 'radio'"> <i class="fa fa-leaf"></i> {{trans('admin.fieldname_item_type_radio')}}</td>
                <td v-if="item.type == 'select'"> <i class="fa fa-leaf"></i> {{trans('admin.fieldname_item_type_select')}}</td>
                <td v-if="item.display_type == 1"> <i class="fa fa-magnet"></i> {{trans('admin.fieldname_item_displaytype1')}}</td>
                <td v-if="item.display_type == 2"> <i class="fa fa-thumb-tack"></i> {{trans('admin.fieldname_item_displaytype2')}}</td>
                <td>@{{ item.groupclass }}</td>
                @include('admin.include.fieldvalue.orderid')
                @include('admin.include.fieldvalue.status')
                <td>
                  <div class="tools">
                    <button type="button" @click="subval_action(item.id)" class="btn btn-warning" > <i class="fa fa-tags"></i> {{trans('admin.website_action_subval_items')}}</button>
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
             apiurl_list          :'{{ route("post.admin.attributegroup.api_list") }}',
             linkurl_add          :'{{ route("get.admin.attributegroup.add") }}',
             linkurl_edit         :'{{ route("get.admin.attributegroup.edit") }}/',
             linkurl_subval       :'{{ route("get.admin.attributevalue") }}/',
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
            @include('admin.include.vue-methods-link_click_subval')
        }            
})

</script>
@endsection