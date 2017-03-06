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
            <button @click="back_action()" type="button" class="btn btn-default pull-left " style="margin:0 0 0 10px;">
             {{trans('admin.website_action_goback')}} 【{{trans('admin.define_model_wechat_mp')}}： {{$website['info']['name']}}】
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
              <th>{{trans('admin.fieldname_item_headimage')}}</th>
              <th>{{trans('admin.fieldname_item_nick')}}</th>
              <th>{{trans('admin.fieldname_item_sex')}}</th>
              <th>{{trans('admin.fieldname_item_province')}}</th>
              <th>{{trans('admin.fieldname_item_city')}}</th>
              <th>{{trans('admin.fieldname_item_country')}}</th>
              <th>{{trans('admin.fieldname_item_score')}}</th>
              <th>{{trans('admin.fieldname_item_money')}}</th>
              <th>{{trans('admin.fieldname_item_subscribe')}}</th>
              <th>{{trans('admin.fieldname_item_status')}}</th>
              <th>{{trans('admin.fieldname_item_option')}}</th>
            </tr>
            </thead>
            <tbody>
              @include('admin.include.fieldvalue.v-for')
                <td>@{{ item.id }}</td>
                <td><i v-if="item.headimgurl" onclick="open_box_image('@{{item.headimgurl}}')" class="fa fa-file-picture-o"> 查看 </i> <i v-else class="fa fa-file-o" ></i></td>
                <td>@{{ item.nickname }}</td>
                <td>@{{ item.sex }}</td>
                <td>@{{ item.province }}</td>
                <td>@{{ item.city }}</td>
                <td>@{{ item.country }}</td>
                <td>@{{ item.score }}</td>
                <td>@{{ item.money }}</td>
                <td><i v-if="item.subscribe == 0"  class="fa fa-toggle-off"> {{trans('admin.website_status_no_subscribe')}} </i> <i v-if="item.subscribe == 1"  class="fa fa-toggle-on"> {{trans('admin.website_status_subscribe')}} </i></td>
                @include('admin.include.fieldvalue.status')
                <td>
                 <div class="tools">
                    @ability('admin', 'set_status')
                    <button v-if="item.status == 1"  type="button" @click="get_one_action(item.id,'status')"  class="btn btn-primary" > <i class="fa fa-toggle-off"></i> {{trans('admin.website_action_status')}}</button>
                    <button v-else  type="button" @click="get_one_action(item.id,'status')"  class="btn btn-danger" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_status')}}</button>
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
             apiurl_list          :'{{ route("post.admin.wechatuser.api_list") }}',
             linkurl_back         :'{{ route("get.admin.wechat.manage") }}/{{$website["wechat_id"]}}',
             @include('admin.include.vue-apiurl-action-one')
             @include('admin.include.vue-apiurl-action-delete')
             @include('admin.include.vue-pages-dataitems')
             @include('admin.include.vue-pages-pageparams-wechat')
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
            @include('admin.include.vue-methods-link_click_page')
            @include('admin.include.vue-methods-link_click_back')
            @include('admin.include.vue-methods-link_click_delete')
        }            
})

</script>
@endsection