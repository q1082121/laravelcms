/*点击删除*/
delete_action:function(data)
{
    this.paramsdata.id=data;
    this.$http.post(this.apiurl_delete,this.paramsdata,{
        @include('admin.include.vue-http-before')
    })
    .then((response) => 
    {
    this.return_info_action(response);

    },@include('admin.include.vue-http-then-error'))
    @include('admin.include.vue-http-catch-error')
},