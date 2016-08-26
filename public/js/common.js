/*公共js片段存储 start */
//cookie相关函数
function set_cookie(name, value, expires, path, domain, secure)
{
// set time, it's in milliseconds
var today = new Date();
today.setTime( today.getTime() );

if ( expires )
{
expires = expires * 1000 * 60 * 60 * 24;
}
var expires_date = new Date( today.getTime() + (expires) );

document.cookie = name + "=" +escape( value ) +
( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
( ( path ) ? ";path=" + path : "" ) +
( ( domain ) ? ";domain=" + domain : "" ) +
( ( secure ) ? ";secure" : "" );
}

function get_cookie(name) {
var start = document.cookie.indexOf(name + "=");
var len = start + name.length + 1;
if ((!start) && (name != document.cookie.substring(0, name.length )))
{
return null;
}
if (start == -1) return null;
var end = document.cookie.indexOf(";", len);
if (end == -1) end = document.cookie.length;
return (document.cookie.substring(len, end));
}
//
//	确定下拉列表的值
//
function checkall(form)
{
	for (var i=0;i<form.elements.length;i++)
	{
		var e = form.elements[i];
		if (e.Name != "chkall")
		e.checked = form.chkall.checked;
	}
}

function js_set_sel(obj, val)
{
    for (i=0; i<obj.length; i++)
    {
        if (obj.options[i].value == val)
        {
            obj.options[i].selected = true;
            break;
        }
    }
}
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
 * 时间：2015年10月20日
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
$(document).ready(function(){ 
	/*select 分页触发表单*/
	$('.selpage').change(function(){
		var oform = $(this).closest('form');
		oform.get(0).submit();
	}
	);

});
/***********************************
 * 方法名：js链接地址跳转函数
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月8日
 ***********************************/
function localcul($url)
{
	location.href=$url;
}
/***********************************
 * 方法名：js链接地址跳转函数（main框架）
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月8日
 ***********************************/
function main_localcul($url)
{
	main.location.href=$url;
}
/***********************************
 * 方法名：js返回上一页函数
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月8日
 ***********************************/
function goback()
{
	history.go(-1);
}
/***********************************
 * 方法名：调用layer询问框
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年6月8日
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
/*公共jquery片段存储 start */
/***********************************
 * 方法名：layer 成功提示
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function layermsg_s(infos,linkurl)
{
	layer.msg(infos, {
	    icon: 6,	//1
	    shade: [0.8, '#393D49'],
	    time: 2000     //2秒关闭 2000（如果不配置，默认是3秒）
	}, function(){
	    location.href=linkurl;
	});  
}
/***********************************
 * 方法名：layer 成功提示【刷新页面】
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function layermsg_success_reload(infos)
{
    layer.msg(infos, {
        icon: 6,    //1
        shade: [0.8, '#393D49'],
        time: 2000     //2秒关闭 2000（如果不配置，默认是3秒）
    }, 
    function()
    {
        location.reload();
    });  
}
/***********************************
 * 方法名：layer 错误提示
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function layermsg_e(infos)
{
	layer.msg(infos, 
	{
	    icon: 5,	//1
	    shade: [0.8, '#393D49'],
	    time: 2000     //2秒关闭 2000（如果不配置，默认是3秒）
	}, 
	function()
	{
	    location.reload();
	});  
}
/***********************************
 * 方法名：layer 成功提示【不在跳转】
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function layermsg_success(infos)
{
	layer.msg(infos, {
	    icon: 6,	//1
	    shade: [0.8, '#393D49'],
	    time: 2000     //2秒关闭 2000（如果不配置，默认是3秒）
	});  
}
/***********************************
 * 方法名：layer 错误提示【不在跳转】
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function layermsg_error(infos)
{
	layer.msg(infos, 
	{
	    icon: 5,	//1
	    shade: [0.8, '#393D49'],
	    time: 2000     //2秒关闭 2000（如果不配置，默认是3秒）
	});  
}
/***********************************
 * 方法名：获取地区三级联动
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function dynamic_Select(id,areadname,level)
{
    /*
    if (areadname === undefined) areadname = "area_xid";
    if (level === undefined) areadname = 4;
    */
    areadname=areadname || "area_aid";
    level=level || 4;
        $.ajax({
        type: "GET",
        url: "/User/Comapi/area_ajax/",
        data: "aid=" + id+"&level=" + level,
        dataType: "html",
        success: 
        function(html){
            if(level==2)
            {
                $("#area_cid").empty();
                $("<option></option>").val("").text("请选择市级").appendTo($("#area_cid"));
                $("#area_xid").empty();
                $("<option></option>").val("").text("请选择县级").appendTo($("#area_xid"));
                $("#"+areadname).html(html); 
            }
            else if(level==3)
            {
                $("<option></option>").val("").text("请选择县级").appendTo($("#area_xid"));
                $("#"+areadname).html(html);
            }
            else
            {
                $("#"+areadname).html(html);
            }

              
        }
});
}
/***********************************
 * 方法名：iframe自适应高度(兼容多种浏览器)
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function iFrameHeight(idname) {
	var ifm= document.getElementById(idname);
    var subWeb = document.frames ? document.frames[idname].document :ifm.contentDocument;
    if(ifm != null && subWeb != null) {
        ifm.height = subWeb.body.scrollHeight;
    }
}
/***********************************
 * 方法名：验证手机号码是否注册
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function onBlur_check()
{
	var forminput=document.getElementById("mobile");
	var	inputval = forminput.value;
	var loadi;
	if(forminput.value.length >= 11)
	{
		$(function()
				{
				 $.ajax({
						type:"POST",
						url:"/User/Register/checkauth/",
						data:{"mobile":inputval,"authname":'mobile',"type":2},
						dataType:'json',
						beforeSend: function (){ 
							loadi=layer.load("检测中...");
						},
						success:function(msg)
						{
							layer.close(loadi);
							if(msg.success==1)
							{
								var find_data=msg.data;
								if (find_data.data==0)
								{
									var msgs=find_data.message;
									//layermsg_success(msgs);
								}
								else
								{
									var msgs=find_data.message;
									var forminput=document.getElementById("mobile");
									forminput.value="";
									layermsg_error(msgs);
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
	else if(forminput.value.length >0)
	{
		var msgs="请输入有效长度号码";
		layermsg_error(msgs);
	}
}
/***********************************
 * 方法名：设置默认发短信按钮可点击
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
$(function()
{
  $('#verifybutton').attr("disabled", false);
}); 
/***********************************
 * 方法名：发送短信方法
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function sendcode(val,sms_token)
{
  var forminput=document.getElementById("mobile");
  var inputval = forminput.value;
  var loadi;
  var token=sms_token;
  if(forminput.value.length >= 11)
  {
    $(function()
    {
     $.ajax({
        type:"POST",
        url:"/User/Comapi/send_mobile_verifycode",
        data:{"mobile":inputval,"token":token},
        dataType:'json',
        beforeSend: function (){ 
          loadi=layer.load("发送至手机中...");
        },
        success:function(msg)
        {
          layer.close(loadi);
          if(msg.success==1)
          {
            countdown=60;
            set_time(countdown);
            layermsg_success(msg.info);
          }
          else
          {
            layermsg_error(msg.info);
          }
        },
        error:function()
        {
          layer.close(loadi);
          var msgs="响应请求失败，请刷新页面重新提交！";
          layermsg_error(msgs);
        }     
      })
    });
  }
  else
  {
    var msgs="请输入有效长度号码";
    layermsg_error(msgs);
  } 
}
/***********************************
 * 方法名：设置发送短信按钮倒计时 
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function set_time(countdown) 
{ 
  var timeact;
  if (countdown == 0) { 
    document.getElementById("verifybutton").removeAttribute("disabled");  
    document.getElementById("verifybutton").value="短信获取验证码";
    clearTimeout(timeact);
  }
  else
  { 
    document.getElementById("verifybutton").setAttribute("disabled", true); 
    document.getElementById("verifybutton").value="重新发送(" + countdown + ")"; 
    countdown--; 
    timeact=setTimeout(function() 
    { set_time(countdown) },1000); 
  } 
  
} 
/***********************************
 * 方法名：从 file 域获取 本地图片 url 
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function getFileUrl(sourceId) 
{ 
	var url; 
	if (navigator.userAgent.indexOf("MSIE")>=1) 
	{ 
		// IE 
		url = document.getElementById(sourceId).value; 
	} 
	else if(navigator.userAgent.indexOf("Firefox")>0) 
	{ 
		// Firefox 
		url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0)); 
	} 
	else if(navigator.userAgent.indexOf("Chrome")>0) 
	{ 
		// Chrome 
		url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0)); 
	} 
	return url; 
}
/***********************************
 * 方法名：判断上传文件类型
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function getPhotoinfo(obj,default_src,attachment,nonepic){
    photoExt=obj.value.substr(obj.value.lastIndexOf(".")).toLowerCase();//获得文件后缀名
    if(photoExt!='.jpg' && photoExt!='.JPG' && photoExt!='.png' && photoExt!='.PNG' && photoExt!='.jpeg' && photoExt!='.JPEG')
    {
        var imgsrc = default_src; 
        $("#"+nonepic).attr("src", imgsrc);

        var obj_attachment = document.getElementById(attachment) ; 
        obj_attachment.outerHTML=obj_attachment.outerHTML; 

        layer.alert("请选择jpg/png类型图片"+photoExt,{icon: 7,skin: 'layer-ext-moon'});
        return false;
    }
    else
    {
        var imgsrc=getFileUrl(attachment);
        $("#"+nonepic).attr("src", imgsrc);
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
 * 方法名：删除记录方法 
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2016年6月3日
 ***********************************/ 
function do_del_confir(links)
{
    layer.confirm('您确定要删除?', 
    {
        btn: ['确定','取消'], //按钮
        shade: [0.8, '#333'],
        skin: 'layui-layer-rim',
    }, 
    function()
    {
        var loadi;  
        $.ajax({
                type:"GET",
                url:links,
                dataType:'json',
                beforeSend: function (){ 
                loadi=layer.load("处理中...");
                },
                success:function(msg)
                {
                    layer.close(loadi);
                    if(msg.success==1)
                    {
                        layermsg_success_reload(msg.info);
                    }
                    else
                    {
                        layermsg_error(msg.info);
                    }
                },
                error:function()
                {
                    layer.close(loadi);
                    layer.msg("响应繁忙，稍后再试!", {shift: 6});
                }     
          });
    }, 
    function()
    {
        layer.msg("取消删除", {shift: 6});
    }
    );
}


/***********************************
 * 方法名：询问方法 
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function make_confirminfo(info,links,onethis)
{
    layer.confirm('您确定要【'+info+"】?", 
    {
        btn: ['确定','取消'], //按钮
        shade: false //不显示遮罩
    }, 
    function()
    {
        var loadi;  
        $.ajax({
                type:"GET",
                url:links,
                dataType:'json',
                beforeSend: function (){ 
                loadi=layer.load("处理中...");
                },
                success:function(msg)
                {
                    layer.close(loadi);
                    if(msg.success==1)
                    {
                        var msgdata=msg.data;
                        if(msgdata.curl)
				        {
                            if(info=='退出登录')
                            {
                                layer.msg(msg.info, {
                                    icon: 6,    //1
                                    shade: [0.8, '#393D49'],
                                    time: 2000     //2秒关闭 2000（如果不配置，默认是3秒）
                                }, function(){
                                    window.parent.location.href=msgdata.curl;
                                });  
                            }
                            else
                            {
                                layermsg_s(msg.info,msgdata.curl);
                            }
				        }
				        else
				        {
                          if(msgdata.isreload)
                          {
                            layermsg_success_reload(msg.info);
                          }
                          else
                          {
                            layermsg_success(msg.info);
                          }
				        }
                    }
                    else
                    {
                    	layermsg_error(msg.info);
                    }
                },
                error:function()
                {
                    layer.close(loadi);
                    layer.msg("响应繁忙，稍后再试!", {shift: 6});
                }     
          });
    }, 
    function()
    {
        layer.msg("取消"+info, {shift: 6});
    }
    );
}
/***********************************
 * 方法名：触发登录窗口
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2016年3月19日
 ***********************************/
function box_open(divid)
{
    layer.open({
        type: 1,
        shade: [0.8, '#333'],
        skin: 'layui-layer-rim',
        area: ['520px', '300px'], 
        title: false, //不显示标题
        content: $('#'+divid), //捕获的元素
        cancel: function(index)
        {
            layer.close(index);
        }
    });
}

/***********************************
 * 方法名：触发弹出框
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2016年3月19日
 ***********************************/
function open_box(divid,isclose,width,height)
{
    layer.open({
        type: 1,
        shade: [0.8, '#333'],
        closeBtn: isclose,
        skin: 'layui-layer-rim',
        area: [width, height], 
        title: false, //不显示标题
        shadeClose: false,
        content: $('#'+divid), //捕获的元素
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
 * 方法名：触发框架弹出框
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2016年3月19日
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
 * 方法名：在图片上停留时逐渐增强或减弱的透明效果
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2016年3月19日
 ***********************************/
$(document).ready(function()
{
    $(".thumbs img").fadeTo("slow", 0.8); // This sets the opacity of the thumbs to fade down to 60% when the page loads

    $(".thumbs img").hover(function(){
        $(this).fadeTo("slow", 1.0); // This should set the opacity to 100% on hover
    },function(){
        $(this).fadeTo("slow", 0.8); // This should set the opacity back to 60% on mouseout
    });
});
/***********************************
* 方法名：js HTML实体 转换为 html字符串 htmlspecialchars_decode
* 作者： Tommy（rubbish.boy@163.com）
* 时间：2016年6月6日
***********************************/
function htmlspecialchars_decode(str){           
  str = str.replace(/&amp;/g, '&'); 
  str = str.replace(/&lt;/g, '<');
  str = str.replace(/&gt;/g, '>');
  str = str.replace(/&quot;/g, "'");  
  str = str.replace(/&#039;/g, "'");  
  return str;  
}