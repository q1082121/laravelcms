/*生成自定义菜单缓存*/
create_menu:function()
{
    this.$http.post(this.apiurl_menu,this.menudata,{
    @include('admin.include.vue-http-before')
    })
    .then((response) => 
    {
    this.return_info_action(response);

    },@include('admin.include.vue-http-then-error'))
    @include('admin.include.vue-http-catch-error')
}