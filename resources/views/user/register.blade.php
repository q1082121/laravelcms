@extends('layouts.login')
@section('content')
	<!--SIGN UP-->
	<h1 style="padding-top:3em;">{{$website['register_name']}}{{$website['website_center_tip']}}</h1>
	<div class="login-form">
		<!--<div class="close"> </div>-->
			<div class="head-info">
				<label class="lbl-1"> </label>
				<label class="lbl-2"> </label>
				<label class="lbl-3"> </label>
				<style>
				.register_div{width:120px;height:35px;font-size:20px;line-height:35px;text-align:center;color:#fff;background:#555;margin:5px 0 0 10px;border-radius: 5px;-webkit-border-radius: 5px;-moz-border-radius: 5px;-o-border-radius: 5px;}
				</style>
				<a href="{{ route('get.user.login') }}">
				<div class="register_div">
					用户登录
				</div>
				</a>
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
			        layer.alert("{{trans('register.failure_tip1')}}",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    @elseif ($website['type'] == 2)
			    var username = frm.username;
				var email = frm.email;
			    if(username.value=="" )
			    {
			        layer.alert("{{trans('register.failure_tip2')}}",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    if(username.value.length <4 )
			    {
			        layer.alert("{{trans('register.failure_tip3')}}",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
				if(email.value=="" || isEmail(email.value)==false)
			    {
			        layer.alert("{{trans('register.failure_tip1')}}",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }

			    @elseif ($website['type'] == 3)
			    var mobile = frm.mobile;
			    if(mobile.value=="" || validatemobile(mobile.value)==false)
			    {
			        layer.alert("{{trans('register.failure_tip4')}}",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    @endif

			    if(userpwd.value=="")
			    {
			        layer.alert("{{trans('register.failure_tip7')}}",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    if(userpwd.value.length<6)
			    {
			        layer.alert("{{trans('register.failure_tip8')}}",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    if(reuserpwd.value=="")
			    {
			        layer.alert("{{trans('register.failure_tip9')}}",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    if(userpwd.value && reuserpwd.value && userpwd.value!=reuserpwd.value)
			    {
			        layer.alert("{{trans('register.failure_tip10')}}",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    if(code.value=="")
			    {
			        layer.alert("{{trans('register.failure_tip11')}}",{icon: 7,skin: 'layer-ext-moon'});
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
							headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
                            type:"POST",
                            url:"{{ route('post.user.register') }}",
                            data:$('#do_form').serialize(),
                            dataType:'json',
                            beforeSend: function (){
                                loadi=layer.load("{{trans('default.doing')}}");
                            },
                            success:function(msg)
                            {
                                layer.close(loadi);
                                if(msg.success==1)
                                {
                                    var msg_data=msg.data;
                                    var curl=msg_data.curl;
                                    layermsg_s(msg.info,curl);
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
                                var msgs="{{trans('default.doing_failure')}}";
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
				<input type="text" class="text" onBlur="onBlur_check('email');" id="email" name="email" value="" placeholder="：" style="width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/email.png') no-repeat left center;">
				@elseif ($website['type'] == 2)
				<input type="hidden" name="type" value="2">
				<input type="text" class="text" onBlur="onBlur_check('username');" id="username" name="username" value="" placeholder="：" style="width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/username.png') no-repeat left center;">
				<input type="text" class="text" onBlur="onBlur_check('email');" id="email" name="email" value="" placeholder="：" style="margin-top:0;width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/email.png') no-repeat left center;">
				@elseif ($website['type'] == 3)
				<input type="hidden" name="type" value="3">
				<input type="text" class="text" onBlur="onBlur_check('mobile');" id="mobile" name="mobile" value="" placeholder="：" style="width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/mobile.png') no-repeat left center;">
				@endif
				<input id="password" type="password"  name="userpwd" placeholder="："  style="margin-bottom:0;width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/pwd.png') no-repeat left center;">
				<input id="password" type="password"  name="reuserpwd" placeholder="：" style="margin-bottom:0;width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/repwd.png') no-repeat left center;">
				<input type="text" name="code" maxlength="5" placeholder="验证码"  style="margin-top:0;width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/code.png') no-repeat left center;">
          		<a onclick="javascript:re_captcha();" >
          			<img src="{{ route('get.captcha.register') }}/1" style="width:30%;margin-top:1em;margin-bottom:1em;"  alt="验证码" title="刷新图片"  height="40" id="c2c98f0de5a04167a9e427d883690ff6" border="0">
          		</a>
				<script>  
				  function re_captcha() {
				    $url = "{{ route('get.captcha.register') }}";
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
