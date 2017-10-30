@extends('layouts.admin')
@section('content')

<!-- Main content -->
<section class="content">
  <div class="row" id="app-content">
    <div class="col-md-3">
    <a href="{{ route('get.admin.letter.add') }}" class="btn btn-primary btn-block margin-bottom">{{trans('admin.website_action_add')}}</a>
    @include('admin.letter.nav')
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$website['cursitename']}}</h3>
          <div class="box-tools pull-right">
            @ability('admin', 'search')
            <div style="position: absolute;right:170px;top:0;width: 120px;">
            <select  v-model="pageparams.way" style="width: 100%;height:30px;line-height:30px;padding:1% 3%;">
              <option v-for="item in pageparams.wayoption" value="@{{ item.value }}">@{{ item.text }}</option>
            </select>
            </div>
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" autocomplete="off" class="form-control pull-right" placeholder="Search" v-model="pageparams.keyword" value="@{{ pageparams.keyword }}">
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default" @click="search_list_action()" ><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
            @endability
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <thead>
              <tr>
                <th>{{trans('admin.fieldname_item_id')}}</th>
                <th>{{trans('admin.fieldname_item_isstar')}}</th>
                <th>{{trans('admin.fieldname_item_title')}}</th>
                <th>{{trans('admin.fieldname_item_to_user')}}</th>
                <th>{{trans('admin.fieldname_item_created_at')}}</th>
                <th>{{trans('admin.fieldname_item_option')}}</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="item in datalist" >
                <td class="mailbox-id">@{{ item.id }}</td>
                <td class="mailbox-star" v-if="item.isstar_from == 1 && item.email_from == email " ><a href="javascript:void(0);" @click="get_one_action(item.id,'isstar_from')" ><i class="fa fa-star text-yellow"></i></a></td>
                <td class="mailbox-star" v-if="item.isstar_from == 0 && item.email_from == email " ><a href="javascript:void(0);" @click="get_one_action(item.id,'isstar_from')"><i class="fa fa-star-o text-yellow"></i></a></td>
                <td class="mailbox-star" v-if="item.isstar_to == 1 && item.email_to == email " ><a href="javascript:void(0);" @click="get_one_action(item.id,'isstar_to')" ><i class="fa fa-star text-yellow"></i></a></td>
                <td class="mailbox-star" v-if="item.isstar_to == 0 && item.email_to == email " ><a href="javascript:void(0);" @click="get_one_action(item.id,'isstar_to')"><i class="fa fa-star-o text-yellow"></i></a></td>
                <td class="mailbox-subject"><b>@{{ item.title }}</b></td>
                <td class="mailbox-attachment">@{{ item.email_to }}</td>
                <td class="mailbox-date">@{{ item.created_at }}</td>
                @if(getCurrentMethodName()=='index')
                <td>
                  <div class="tools">
                    <button v-if="actionname =='index' && item.istrash_to == 0 && item.isdel_to == 0 "  type="button" @click="get_one_action(item.id,'istrash_to')"  class="btn btn-primary" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_trash')}}</button>
                  </div>
                </td>
                @endif
                @if(getCurrentMethodName()=='send')
                <td>
                  <div class="tools">
                    <button v-if="actionname =='send' && item.istrash_from == 0 && item.isdel_from == 0 "  type="button" @click="get_one_action(item.id,'istrash_from')"  class="btn btn-primary" > <i class="fa fa-toggle-off"></i> {{trans('admin.website_action_trash')}}</button>
                  </div>
                </td>
                @endif
                @if(getCurrentMethodName()=='star')
                <td>
                  <div class="tools">
                    <button v-if="actionname =='star' && item.istrash_from == 0  && item.isdel_from == 0 && item.email_from == email"  type="button" @click="get_one_action(item.id,'istrash_from')"  class="btn btn-primary" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_trash')}}</button>
                    <button v-if="actionname =='star' && item.istrash_to == 0 && item.isdel_to == 0 && item.email_to == email"  type="button" @click="get_one_action(item.id,'istrash_to')"  class="btn btn-primary" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_trash')}}</button>
                  </div>
                </td>
                @endif
                @if(getCurrentMethodName()=='trash')
                <td>
                  <div class="tools">
                    <button v-if="actionname =='trash' && item.istrash_from == 1  && item.isdel_from == 0 && item.email_from == email"  type="button" @click="get_one_action(item.id,'istrash_from')"  class="btn btn-danger" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_back')}}</button>
                    <button v-if="actionname =='trash' && item.istrash_to == 1 && item.isdel_to == 0 && item.email_to == email"  type="button" @click="get_one_action(item.id,'istrash_to')"  class="btn btn-danger" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_back')}}</button>
                    @ability('admin', 'delete')
                    <button v-if="actionname =='trash' && item.istrash_from == 1 && item.isdel_from == 0 " type="button" @click="get_one_action(item.id,'isdel_from')" class="btn btn-danger" > <i class="fa fa-trash"></i> {{trans('admin.website_action_delete')}}</button>
                    <button v-if="actionname =='trash' && item.istrash_to == 1 && item.isdel_to == 0 " type="button" @click="get_one_action(item.id,'isdel_to')" class="btn btn-danger" > <i class="fa fa-trash"></i> {{trans('admin.website_action_delete')}}</button>
                    @endability
                  </div>
                </td>
                @endif
              </tr>
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <!-- /.box-body -->
        @include('admin.include.pages')
        <!-- /.page -->
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->


<script type="text/javascript">
new Vue({
    @include('admin.include.vue-el')
    data: {
             apiurl_list          :'{{ route("post.admin.letter.api_list") }}',
             apiurl_count         :'{{ route("post.admin.letter.api_count") }}',
             email                :'{{$website["website_user"]["email"]}}' ,
             actionname           :'{{getCurrentMethodName()}}',
             @include('admin.include.vue-apiurl-action-one')
             @include('admin.include.vue-apiurl-action-delete')
             @include('admin.include.vue-pages-dataitems')
             @include('admin.include.vue-pages-pageparams')
             @include('admin.include.vue-pages-paramsdata')
             countdata:
             {
                    count_index    :0,
                    count_send     :0,
                    count_star     :0,
                    count_trash    :0,
             }
          },
    created: function ()
            { 
            this.pageparams.actionname=this.actionname;  
            //这里是vue初始化完成后执行的函数 
            this.get_list_action();
          },
    @include('admin.include.vue-pages-computed')      
    methods: {
            //获取列表数据
            get_count_action:function()
            {
              this.$http.post(this.apiurl_count,{'email':this.email},{
                before:function(request)
                {
                  loadi=layer.load("...");
                },
              })
              .then((response) => 
              {
                  layer.close(loadi);
                  var statusinfo=response.data;
                  if(statusinfo.status==1)
                  {
                      this.countdata=statusinfo.resource;
                  }

              },(response) => 
              {
                //响应错误
                layer.close(loadi);
                var msg="{{trans('admin.message_outtime')}}";
                layermsg_error(msg);
              })
              .catch(function(response) {
                //异常抛出
                layer.close(loadi);
                var msg="{{trans('admin.message_error')}}";
                layermsg_error(msg);
              })

            },
            get_list_action:function()
            {

              this.$http.post(this.apiurl_list,this.pageparams,{
                before:function(request)
                {
                  loadi=layer.load("...");
                },
              })
              .then((response) => 
              {
                this.do_list_action(response);
                this.get_count_action();
              },(response) => 
              {
                //响应错误
                layer.close(loadi);
                var msg="{{trans('admin.message_outtime')}}";
                layermsg_error(msg);
              })
              .catch(function(response) {
                //异常抛出
                layer.close(loadi);
                var msg="{{trans('admin.message_error')}}";
                layermsg_error(msg);
              })

            },
            @include('admin.include.vue-methods-action_list_do')
            @include('admin.include.vue-methods-action_list_search')
            @include('admin.include.vue-methods-link_click_page')
            @include('admin.include.vue-methods-action_one_get')
            @include('admin.include.vue-methods-action_info_return')
        }            
})

</script>
@endsection