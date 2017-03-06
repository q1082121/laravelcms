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
              <th>{{trans('admin.fieldname_item_classid')}}</th>
              <th>{{trans('admin.fieldname_item_type')}}</th>
              <th>{{trans('admin.fieldname_item_title')}}</th>
              <th>{{trans('admin.fieldname_item_attachment')}}</th>
              <th>{{trans('admin.fieldname_item_fraction')}}</th>
              @if ($website['type'] == 3)
              <th>{{trans('admin.fieldname_item_is_answer')}}</th>
              @endif
              <th>{{trans('admin.fieldname_item_status')}}</th>
              <th>{{trans('admin.fieldname_item_option')}}</th>
            </tr>
            </thead>
            <tbody>
              @include('admin.include.fieldvalue.v-for')
                <td>@{{ item.id }}</td>
                <td>@{{ item.classname }}</td>
                <td v-if="item.type == 1"> <i class="fa fa-leaf"></i> {{trans('admin.define_model_question1')}}</td>
                <td v-if="item.type == 2"> <i class="fa fa-leaf"></i> {{trans('admin.define_model_question2')}}</td>
                <td v-if="item.type == 3"> <i class="fa fa-leaf"></i> {{trans('admin.define_model_question3')}}</td>
                <td>@{{ item.title}}</td>
                @include('admin.include.fieldvalue.attachment')
                <td>@{{ item.score }}</td>
                @if ($website['type'] == 3)
                <td><i v-if="item.is_answer == 0"  class="fa fa-remove"></i> <i v-if="item.is_answer == 1"  class="fa fa-check"></i></td>
                @endif
                @include('admin.include.fieldvalue.status')
                <td>
                  <div class="tools">
                    @if ($website['type'] != 3)
                    <button type="button" @click="questionoption_action(item.id)" class="btn btn-primary" > <i class="fa fa-stack-overflow"></i> {{trans('admin.website_navigation_question_option')}}</button>
                    @endif
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
             apiurl_list          :'{{ route("post.admin.question.api_list") }}',
             linkurl_add          :'{{ route("get.admin.question.add") }}/{{$website["type"]}}',
             linkurl_edit         :'{{ route("get.admin.question.edit") }}/',
             linkurl_option       :'{{ route("get.admin.questionoption") }}/',
             @include('admin.include.vue-apiurl-action-one')
             @include('admin.include.vue-apiurl-action-delete')  
             @include('admin.include.vue-pages-dataitems')
             @include('admin.include.vue-pages-pageparams-type')
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
            questionoption_action:function(data)
            {
                window.location.href=this.linkurl_option+data;
            },
        }            
})
</script>
@endsection