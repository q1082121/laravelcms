Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name=csrf-token]').getAttribute('content')
Vue.http.options.emulateJSON = true;
/***********************************
 * 方法名：用户注册验证是否存在
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function onBlur_check(fieldname,type)
{
    var type=type?type:1;
	var forminput=document.getElementById(fieldname);
	var	fieldval = forminput.value;
    var rule=1;
	var loadi;
    switch(fieldname)
    {
        case 'username':
                        if(fieldval=="" )
                        {
                            rule=0;
                        }
                        if(fieldval.length <4 )
                        {
                            layer.alert("用户名长度至少4位",{icon: 7,skin: 'layer-ext-moon'});
                            rule=0;
                        }
                        else
                        {
                            rule=1;
                        }
        break;
        case 'email':
                        if(fieldval=="")
                        {
                            rule=0;
                        }
                        else if(isEmail(fieldval)==false)
                        {
                            layer.alert("请输入有效的邮箱",{icon: 7,skin: 'layer-ext-moon'});
                            forminput.value="";
                            rule=0;
                        }
                        else
                        {
                            rule=1;
                        }
        break;

        case 'mobile':
                        if(fieldval=="")
                        {
                            rule=0;
                        }
                        else if(validatemobile(fieldval)==false)
                        {
                            layer.alert("请输入有效的手机号",{icon: 7,skin: 'layer-ext-moon'});
                            rule=0;
                        }
                        else
                        {
                            rule=1;
                        }
        break;
        default :
                    rule=0;
        break;
    }

	if(rule==1)
	{
		$(function()
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:"/user/register/exit_api",
                data:{"fieldval":fieldval,"fieldname":fieldname,'type':type},
                dataType:'json',
                beforeSend: function (){ 
                    loadi=layer.load("检测中...");
                },
                success:function(msg)
                {
                    layer.close(loadi);
                    if(msg.success==1)
                    {
                        if (msg.data==0)
                        {
                            if(type==2)
                            {
                                var msgs=msg.info;
                                forminput.value="";
                                layermsg_error(msgs);
                            }
                        }
                        else
                        {
                            if(type==1)
                            {
                                var msgs=msg.info;
                                forminput.value="";
                                layermsg_error(msgs);
                            }
                        }
                    }
                    else
                    {
                        var msgs="响应请求失败！";
                        layermsg_error(msgs);
                    }
                },
                error:function()
                {
                    layer.close(loadi);
                    var msgs="响应请求失败！";
                    layermsg_error(msgs);
                }     
            })
        });
	}
}