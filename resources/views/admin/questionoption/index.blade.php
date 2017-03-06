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
            <button @click="back_action()" type="button" class="btn btn-default pull-left " style="margin:0 0 0 10px;">
             {{trans('admin.website_action_back_question')}} 【{{trans('admin.define_model_questionoption_tip')}}： {{$website['info']['title']}}】
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
              <th>{{trans('admin.fieldname_item_title')}}</th>
              <th>{{trans('admin.fieldname_item_attachment')}}</th>
              <th>{{trans('admin.fieldname_item_is_answer')}}</th>
              <th>{{trans('admin.fieldname_item_status')}}</th>
              <th>{{trans('admin.fieldname_item_option')}}</th>
            </tr>
            </thead>
            <tbody>
              @include('admin.include.fieldvalue.v-for')
                <td>@{{ item.id }}</td>
                <td>@{{ item.title }}</td>
                @include('admin.include.fieldvalue.attachment')
                <td><i v-if="item.is_answer == 0"  class="fa fa-remove"></i> <i v-if="item.is_answer == 1"  class="fa fa-check"></i></td>
                @include('admin.include.fieldvalue.status')
                <td>
                  <div class="tools">
                    <button v-if="item.is_answer == 1"  type="button" @click="get_one_action(item.id,'is_answer')"  class="btn btn-primary" > <i class="fa fa-toggle-off"></i> {{trans('admin.website_action_is_answer')}}</button>
                    <button v-else  type="button" @click="get_one_action(item.id,'is_answer')"  class="btn btn-danger" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_is_answer')}}</button>
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
             apiurl_list          :'{{ route("post.admin.questionoption.api_list") }}',
             linkurl_add          :'{{ route("get.admin.questionoption.add") }}/{{$website["qid"]}}',
             linkurl_edit         :'{{ route("get.admin.questionoption.edit") }}/',
             linkurl_back         :'{{route("get.admin.question")}}/{{$website["info"]["type"]}}',
             @include('admin.include.vue-apiurl-action-one')
             @include('admin.include.vue-apiurl-action-delete')
             @include('admin.include.vue-pages-dataitems')
             @include('admin.include.vue-pages-pageparams-question')
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
            @include('admin.include.vue-methods-link_click_back')
        }            
})

</script>
@endsection