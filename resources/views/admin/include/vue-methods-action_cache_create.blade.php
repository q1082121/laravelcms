/*生成缓存*/
create_cache:function()
{
    this.$http.post(this.apiurl_cache,this.paramsdata,{
        @include('admin.include.vue-http-before')
    })
    .then((response) => 
    {
    this.return_info_action(response);
    },@include('admin.include.vue-http-then-error'))
    @include('admin.include.vue-http-catch-error')
},