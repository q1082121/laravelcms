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
              @include('admin.include.fieldname.id')
              @include('admin.include.fieldname.classid')
              @include('admin.include.fieldname.title')
              @include('admin.include.fieldname.attachment')
              @include('admin.include.fieldname.sources')
              @include('admin.include.fieldname.clicks')
              @include('admin.include.fieldname.orderid')
              @include('admin.include.fieldname.status')
              @include('admin.include.fieldname.option')
            </tr>
            </thead>
            <tbody>
              @include('admin.include.fieldvalue.v-for')
                @include('admin.include.fieldvalue.id')
                @include('admin.include.fieldvalue.classid')
                @include('admin.include.fieldvalue.title')
                @include('admin.include.fieldvalue.attachment')
                @include('admin.include.fieldvalue.sources')
                @include('admin.include.fieldvalue.clicks')
                @include('admin.include.fieldvalue.orderid')
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
             apiurl_list          :'{{ route("post.admin.article.api_list") }}',
             linkurl_add          :'{{ route("get.admin.article.add") }}',
             linkurl_edit         :'{{ route("get.admin.article.edit") }}/', 
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
        }            
})

</script>
@endsection