/*点击页码获取列表数据*/
btnClick: function(data)
{   
    if(data != this.current_page)
    {
        this.pageparams.page=data;
        this.get_list_action();
    }
},