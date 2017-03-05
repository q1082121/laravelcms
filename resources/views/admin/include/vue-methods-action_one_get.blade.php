/*点击获取一键操作*/
get_one_action:function(data,fields)
{
    this.paramsdata.id=data;
    this.paramsdata.fields=fields;
    this.$http.post(this.apiurl_one_action,this.paramsdata,{
        @include('admin.include.vue-http-before')
    })
    .then((response) => 
    {
    this.return_info_action(response);
    },@include('admin.include.vue-http-then-error'))
    @include('admin.include.vue-http-catch-error')
},