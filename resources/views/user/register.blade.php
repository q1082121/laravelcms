@extends('layouts.login')
@section('content')
	<!--SIGN UP-->
	<h1 style="padding-top:3em;">账号注册中心界面</h1>
	<div class="login-form">
		<!--<div class="close"> </div>-->
			<div class="head-info">
				<label class="lbl-1"> </label>
				<label class="lbl-2"> </label>
				<label class="lbl-3"> </label>
			</div>
			<div class="clear"> </div>
			<div class="avtar">
				<img src="{{asset('/module/login')}}/images/avtar.png" />
			</div>
			<script type="text/javascript">
			function postcheck_frm()
			{
				frm = document.do_form;
			    
			    
			    var nick = frm.nick;
			    var userpwd = frm.userpwd;
			    var reuserpwd = frm.reuserpwd;
			    var code = frm.code;
			    
			    @if ($website['type'] == 1)
			    var email = frm.email;
			    if(email.value=="" || isEmail(email.value)==false)
			    {
			        layer.alert("请输入有效的注册邮箱!",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    @elseif ($website['type'] == 2)
			    var username = frm.username;
			    if(username.value=="" )
			    {
			        layer.alert("请输入用户名!",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    if(username.value.length <4 )
			    {
			        layer.alert("用户名需4位长度以上!",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    @elseif ($website['type'] == 3)
			    var mobile = frm.mobile;
			    if(mobile.value=="" || validatemobile(mobile.value)==false)
			    {
			        layer.alert("请输入有效的手机号码!",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    @endif

			    if(nick.value=="")
			    {
			        layer.alert("请输入用户昵称!",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    if(nick.value.length>8)
			    {
			        layer.alert("用户昵称超出限制长度!",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    if(userpwd.value=="")
			    {
			        layer.alert("请您填写注册密码!",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    if(userpwd.value.length<6)
			    {
			        layer.alert("密码长度需6位以上!",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    if(reuserpwd.value=="")
			    {
			        layer.alert("请您填写确认密码!",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    if(userpwd.value && reuserpwd.value && userpwd.value!=reuserpwd.value)
			    {
			        layer.alert("您填写注册密码与确认密码不一致!",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    if(code.value=="")
			    {
			        layer.alert("请您填写验证码!",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    

			    return true;
			}
			$(function ()
			 {   
		       $('#do_action').click(function()
		         {
                    if(postcheck_frm())
                    {
                        var loadi;
                        $.ajax({
                            type:"POST",
                            url:"{{ url('/user/register') }}",
                            data:$('#do_form').serialize(),
                            dataType:'json',
                            beforeSend: function (){
                                loadi=layer.load("检测中...");
                            },
                            success:function(msg)
                            {
                                layer.close(loadi);
                                if(msg.success==1)
                                {
                                    var msg_data=msg.data;
                                    var curl=msg_data.curl;
                                    layermsg_success(msg.info);
                                }
                                else
                                {
                                	re_captcha();
                                    layermsg_error(msg.info);
                                }
                            },
                            error:function()
                            {
                                layer.close(loadi);
                                var msgs="响应请求失败！";
                                layer.msg(msgs);
                            }     
                        }) 
                    }
		      });
			 });
			</script>
			<form class="form-horizontal" role="form" id="do_form" name="do_form" method="POST" >
				{{ csrf_field() }}
				@if ($website['type'] == 1)
				<input type="hidden" name="type" value="1">
				<input type="text" class="text" id="email" name="email" value="" placeholder="：" style="width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/email.png') no-repeat left center;">
				@elseif ($website['type'] == 2)
				<input type="hidden" name="type" value="2">
				<input type="text" class="text" id="username" name="username" value="" placeholder="：" style="width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/username.png') no-repeat left center;">
				@elseif ($website['type'] == 3)
				<input type="hidden" name="type" value="3">
				<input type="text" class="text" id="mobile" name="mobile" value="" placeholder="：" style="width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/mobile.png') no-repeat left center;">
				@endif

				<input type="text" class="text" name="nick" value="" placeholder="：" style="margin-top:0;width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/nick.png') no-repeat left center;">
				<input id="password" type="password"  name="userpwd" placeholder="："  style="margin-bottom:0;width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/pwd.png') no-repeat left center;">
				<input id="password" type="password"  name="reuserpwd" placeholder="：" style="margin-bottom:0;width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/repwd.png') no-repeat left center;">
				<input type="text" name="code" maxlength="5" placeholder="验证码"  style="margin-top:0;width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/code.png') no-repeat left center;">
          		<a onclick="javascript:re_captcha();" >
          			<img src="{{ URL('user/register/captcha/1') }}" style="width:30%;margin-top:1em;margin-bottom:1em;"  alt="验证码" title="刷新图片"  height="40" id="c2c98f0de5a04167a9e427d883690ff6" border="0">
          		</a>
				<script>  
				  function re_captcha() {
				    $url = "{{ URL('user/register/captcha') }}";
				        $url = $url + "/" + Math.random();
				        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
				  }
				</script>
				<div class="signin">
					<input type="button" id="do_action" value="注册/Register" >
				</div>
			</form>
	</div>
@endsection
