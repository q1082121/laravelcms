/*------------------------------------------------
 -用户注册信息相关函数
 -------------------------------------------------
 */
/***********************************
 * 方法名：判断邮箱地址有效性
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function isEmail(s) {
	if (s.length > 100)	return false;
	if (s.indexOf("'")!=-1 || s.indexOf("/")!=-1 || s.indexOf("\\")!=-1 || s.indexOf("<")!=-1 || s.indexOf(">")!=-1) return false;
    //edit by liujy 2004-08-04 09:30:01 
    s = s.replace('(', '');
    s = s.replace(')', '');
    s = s.replace('（', '');
    s = s.replace('）', '');

	var regu = "^(([0-9a-zA-Z]+)|([0-9a-zA-Z]+[_.0-9a-zA-Z-]*[_.0-9a-zA-Z]+))@([a-zA-Z0-9-]+[.])+(.+)$";
	//{2}|net|NET|com|COM|gov|GOV|mil|MIL|org|ORG|edu|EDU|int|INT|cn|CN|cc|CC
	var re = new RegExp(regu);
	if (s.search(re) != -1)
		return true;
	else
		return false;
}
/***********************************
 * 方法名：判断手机号码有效性
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function validatemobile(mobile)
{
	var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[6-8]{1})|(18[0-9]{1}))+\d{8})$/;
        if(mobile.length==0)
        {
           return false;
        }    
        else if(mobile.length!=11)
        {
           return false;
        }
        else if(!myreg.test(mobile))
        {
            return false;
        }
        else
        {
        	return true;
        }
}
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
/*------------------------------------------------
 -系统常用相关函数
 -------------------------------------------------
 */
/***********************************
 * 方法名：js链接地址跳转函数
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function localcul($url)
{
	location.href=$url;
}
/***********************************
 * 方法名：js链接地址跳转函数（main框架）
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function main_localcul($url)
{
	main.location.href=$url;
}
/***********************************
 * 方法名：js返回上一页函数
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function goback()
{
	history.go(-1);
}
/***********************************
 * 方法名：调用layer询问框
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function make_confirm(info,link)
{
	layer.confirm('您确定要【'+info+"】?", 
	{
	    btn: ['确定','取消'], //按钮
	    shade: false //不显示遮罩
	}, 
	function()
	{
	    setTimeout("window.location.href='"+link+"'",500);
	}, 
	function()
	{
	    layer.msg("取消"+info, {shift: 6});
	});
}

/***********************************
 * 方法名：layer 成功提示
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function layermsg_s(infos,linkurl)
{
	layer.msg(infos, {
	    icon: 6,	//1
	    shade: [0.8, '#393D49'],
	    time: 1000     //2秒关闭 2000（如果不配置，默认是3秒）
	}, function(){
	    location.href=linkurl;
	});  
}
/***********************************
 * 方法名：layer 成功提示【刷新页面】
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function layermsg_success_reload(infos)
{
    layer.msg(infos, {
        icon: 6,    //1
        shade: [0.8, '#393D49'],
        time: 1000     //2秒关闭 2000（如果不配置，默认是3秒）
    }, 
    function()
    {
        location.reload();
    });  
}
/***********************************
 * 方法名：layer 错误提示
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function layermsg_e(infos)
{
	layer.msg(infos, 
	{
	    icon: 5,	//1
	    shade: [0.8, '#393D49'],
	    time: 1000     //2秒关闭 2000（如果不配置，默认是3秒）
	}, 
	function()
	{
	    location.reload();
	});  
}
/***********************************
 * 方法名：layer 成功提示【不在跳转】
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function layermsg_success(infos)
{
	layer.msg(infos, {
	    icon: 6,	//1
	    shade: [0.8, '#393D49'],
	    time: 1000     //2秒关闭 2000（如果不配置，默认是3秒）
	});  
}
/***********************************
 * 方法名：layer 错误提示【不在跳转】
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function layermsg_error(infos)
{
	layer.msg(infos, 
	{
	    icon: 5,	//1
	    shade: [0.8, '#393D49'],
	    time: 1000     //2秒关闭 2000（如果不配置，默认是3秒）
	});  
}
/***********************************
 * 方法名：iframe自适应高度(兼容多种浏览器)
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function iFrameHeight(idname) {
	var ifm= document.getElementById(idname);
    var subWeb = document.frames ? document.frames[idname].document :ifm.contentDocument;
    if(ifm != null && subWeb != null) {
        ifm.height = subWeb.body.scrollHeight;
    }
}
/***********************************
 * 方法名：ajaxform返回处理 
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function showResponse(responseText, statusText)  
{  
  if(statusText=='success' )
  {
    var darry=responseText.data;
    if(responseText.success==1)
    {
        if(darry.curl)
        {
          layermsg_s(responseText.info,darry.curl);
        }
        else
        {  
          if(darry.isreload==1)
          {
            layermsg_success_reload(responseText.info);  
          }
          else
          {
            layermsg_success(responseText.info);
          }  
        }
    }
    else
    {
        if(darry.isreload==1)
        {
          layermsg_e(responseText.info);
        }
        else
        {
          layermsg_error(responseText.info);
        }
    }
  }
}
/***********************************
* 方法名：js HTML实体 转换为 html字符串 htmlspecialchars_decode
* 作者： Tommy（rubbish.boy@163.com）
***********************************/
function htmlspecialchars_decode(str){           
  str = str.replace(/&amp;/g, '&'); 
  str = str.replace(/&lt;/g, '<');
  str = str.replace(/&gt;/g, '>');
  str = str.replace(/&quot;/g, "'");  
  str = str.replace(/&#039;/g, "'");  
  return str;  
}
/***********************************
* 方法名：layer 弹窗
* 作者： Tommy（rubbish.boy@163.com）
***********************************/
function open_box_image(dir)
{
    layer.open({
      type: 1,
      title: false,
      closeBtn: 0,
      skin: 'layui-layer-nobg', //没有背景色
      shadeClose: true,
      content: '<img src="'+dir+'" width="320px">'
    });
}
/***********************************
 * 方法名：触发框架弹出框
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function open_iframe_box(url,isclose,width,height)
{
    layer.open({
        type: 2,
        shade: [0.8, '#333'],
        area: [width, height], 
        title: "信息窗口", //不显示标题
        maxmin: true, //开启最大化最小化按钮
        content: url, //捕获的元素
        cancel: function(index)
        {
            if(isclose==1)
            {
                layer.close(index);
            }
            else
            {
                location.reload();
            }
        }
    });
}

/***********************************
* 方法名：保存到本地缓存
* 作者： Tommy（rubbish.boy@163.com）
***********************************/
// 
function cache_storageSave(objectName,objectData,isjson) 
{
	if(isjson==1)
	{
		localStorage.setItem(objectName, JSON.stringify(objectData));
	}
	else
	{
		localStorage.setItem(objectName, objectData);
	}
    
}
/***********************************
* 方法名：获取本地缓存
* 作者： Tommy（rubbish.boy@163.com）
***********************************/
function cache_storageLoad(objectName,isjson) 
{
    if (localStorage.getItem(objectName)) 
	{
		if(isjson==1)
		{
			return JSON.parse(localStorage.getItem(objectName))
		}
		else
		{
			return localStorage.getItem(objectName)
		}
        
    } 
	else 
	{
        return false
    }
}


