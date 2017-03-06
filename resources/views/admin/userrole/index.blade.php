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
              <th>{{trans('admin.fieldname_item_keyval')}}</th>
              <th>{{trans('admin.fieldname_item_name')}}</th>
              <th>{{trans('admin.fieldname_item_description')}}</th>
              <th>{{trans('admin.fieldname_item_level')}}</th>
              <th>{{trans('admin.fieldname_item_check_in_score')}}</th>
              <th>{{trans('admin.fieldname_item_login_get_experience')}}</th>
              <th>{{trans('admin.fieldname_item_level_up_experience')}}</th>
              <th>{{trans('admin.fieldname_item_option')}}</th>
            </tr>
            </thead>
            <tbody>
              @include('admin.include.fieldvalue.v-for')
                <td>@{{ item.id }}</td>
                <td v-if="item.type == 1">{{trans('admin.define_model_userrole_type_1')}}</td>
                <td v-if="item.type == 2">{{trans('admin.define_model_userrole_type_2')}}</td>
                <td v-if="item.type == 3">{{trans('admin.define_model_userrole_type_3')}}</td>
                <td v-if="item.type == 4">{{trans('admin.define_model_userrole_type_4')}}</td>
                <td>@{{ item.name }}</td>
                <td>@{{ item.display_name }}</td>
                <td>@{{ item.description }}</td>
                <td>@{{ item.level }}</td>
                <td>@{{ item.check_in_score }}</td>
                <td>@{{ item.login_get_experience }}</td>
                <td>@{{ item.level_up_experience }}</td>
                <td>
                  <div class="tools">
                    @ability('admin', 'edit')
                    <button type="button" @click="edit_action(item.id)" class="btn btn-primary" > <i class="fa fa-edit"></i> {{trans('admin.website_action_edit')}}</button>
                    @endability
                    @ability('admin', 'set_permission')
                    <button type="button" @click="set_action(item.id)" class="btn btn-danger" > <i class="fa fa-magic"></i> {{trans('admin.website_action_set_permission')}}</button>
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
             apiurl_list          :'{{ route("post.admin.userrole.api_list") }}',
             linkurl_add          :'{{ route("get.admin.userrole.add") }}',
             linkurl_edit         :'{{ route("get.admin.userrole.edit") }}/',
             linkurl_set          :'{{ route("get.admin.userrole.set") }}/', 
             @include('admin.include.vue-pages-dataitems')
             @include('admin.include.vue-pages-pageparams')
          },
    @include('admin.include.vue-ready')
    @include('admin.include.vue-pages-computed')
    methods: {
            @include('admin.include.vue-methods-action_list_get')
            @include('admin.include.vue-methods-action_list_do')
            @include('admin.include.vue-methods-action_list_search')
            @include('admin.include.vue-methods-link_click_add')
            @include('admin.include.vue-methods-link_click_edit')
            @include('admin.include.vue-methods-link_click_page')
            //设置操作跳转
            set_action:function(data)
            {
              window.location.href=this.linkurl_set+data;
            },
        }            
})

</script>
@endsection