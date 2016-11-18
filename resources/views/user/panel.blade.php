<div class="row-content am-cf" id="app-content-top">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
            <div class="widget am-cf">
                <div class="tpl-user-card am-text-center widget-body-lg" style="min-height:495px;">
                        <div class="tpl-user-card-title">
                            {{$website['website_user']['username']}}
                        </div>
                        <div class="achievement-subheading">
                            {{$website['website_roleinfo']['display_name']}}
                        </div>
                        <img class="achievement-image" src="{{$website['website_userinfo']['avatar']}}" alt="">
                        <div class="achievement-subheading">
                            <i class="am-icon-at am-text-success tpl-user-panel-status-icon"></i>
                            {{$website['website_user']['email']}}
                        </div>
                        <div class="achievement-subheading">
                            <button type="button" class="am-btn am-btn-default am-radius">每日签到</button>
                        </div>
                </div>
            </div> 
        </div>
        <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
            <div class="widget am-cf">
                <div class="page-header-heading"><span class="am-icon-level-up page-header-heading-icon"></span> {{trans('user.define_name_experience_level')}} </div>
                <table width="100%" class="am-table am-table-compact am-text-nowrap tpl-table-black " id="example-r">
                    <thead>
                        <tr>
                            <th>用户组</th>
                            <th>等级</th>
                            <th>升级经验值</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="gradeX" v-for="item in rolelist" >
                            <td>@{{item.display_name}} <span class="am-icon-diamond" v-if="level == item.level" ></span> </td>
                            <td>@{{item.level}}</td>
                            <td>@{{item.level_up_experience}}</td>
                        </tr>
                        <!-- more data -->
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>        
<script type="text/javascript">
new Vue({
    el: '#app-content-top',
    data: {
             apiurl_check_in      :'{{$website["apiurl_check_in"]}}',  
             rolelist             :eval(htmlspecialchars_decode('{{$website["rolelist"]}}')),
             level                :'{{$website["website_roleinfo"]["level"]}}',
             paramsdata:
             {
                user_id           :'{{$website["website_user"]["id"]}}',
                modelname         :'{{$website["modelname"]}}',
             }
          },
    methods: {
            //返回信息处理
            return_info_action:function(response)
            {
                layer.close(loadi);
                var statusinfo=response.data;
                if(statusinfo.status==1)
                {
                    if(statusinfo.is_reload==1)
                    {
                    layermsg_success_reload(statusinfo.info);
                    }
                    else
                    {
                    if(statusinfo.curl)
                    {
                        layermsg_s(statusinfo.info,statusinfo.curl);
                    }
                    else
                    {
                        layermsg_success(statusinfo.info);
                    }
                    }
                }
                else
                {
                    if(statusinfo.curl)
                    {
                    layermsg_e(statusinfo.info,statusinfo.curl);
                    }
                    else
                    {

                    layermsg_error(statusinfo.info);
                    }
                }
            },
            //每日签到
            check_in_action:function()
            {
              this.$http.post(this.apiurl_check_in,this.paramsdata,{
                before:function(request)
                {
                  loadi=layer.load("...");
                },
              })
              .then((response) => 
              {
                this.return_info_action(response);

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
                var msg="{{trans('admin.website_outtime_error')}}";
                layermsg_error(msg);
              })
            }
    },

})
</script>