@extends('layouts.login')
@section('content')
<script language="javascript"> 
window.onload=function() { document.forms[0].reset();
placeFocus(); 
} 
function placeFocus() { document.forms[0].elements[0].focus();
 // assuming the first element 
} 
</script>
	<!--SIGN UP-->
	<h1 style="padding-top:3em;">{{$website['login_name']}}{{$website['website_center_tip']}}</h1>
	<div class="login-form">
		<!--<div class="close"> </div>-->
			<div class="head-info">
				<label class="lbl-1"> </label>
				<label class="lbl-2"> </label>
				<label class="lbl-3"> </label>
				<style>
				.register_div{width:120px;height:35px;font-size:20px;line-height:35px;text-align:center;color:#fff;background:#555;margin:5px 0 0 10px;border-radius: 5px;-webkit-border-radius: 5px;-moz-border-radius: 5px;-o-border-radius: 5px;}
				</style>
				<a href="{{ route('get.user.register') }}">
				<div class="register_div">
					注册帐号
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
			    
			    var userpwd = frm.userpwd;
			    var code = frm.code;
			    
			    @if ($website['type'] == 1)
			    var email = frm.email;
			    if(email.value=="" || isEmail(email.value)==false)
			    {
			        layer.alert("{{trans('login.failure_tip1')}}",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    @elseif ($website['type'] == 2)
			    var username = frm.username;
			    if(username.value=="" )
			    {
			        layer.alert("{{trans('login.failure_tip2')}}",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    @elseif ($website['type'] == 3)
			    var mobile = frm.mobile;
			    if(mobile.value=="" || validatemobile(mobile.value)==false)
			    {
			        layer.alert("{{trans('login.failure_tip3')}}",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
				@elseif ($website['type'] == 4)
			    var account = frm.account;
			    if(account.value=="")
			    {
			        layer.alert("{{trans('login.failure_account')}}",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    @endif

			    if(userpwd.value=="")
			    {
			        layer.alert("{{trans('login.failure_tip4')}}",{icon: 7,skin: 'layer-ext-moon'});
			        return false;
			    }
			    if(code.value=="")
			    {
			        layer.alert("{{trans('login.failure_tip5')}}",{icon: 7,skin: 'layer-ext-moon'});
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
                            url:"{{ route('post.user.login') }}",
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
								re_captcha();
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
				<input type="text" class="text" id="email" name="email" value="" placeholder="：" style="width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/email.png') no-repeat left center;">
				@elseif ($website['type'] == 2)
				<input type="hidden" name="type" value="2">
				<input type="text" class="text" id="username" name="username" value="" placeholder="：" style="width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/username.png') no-repeat left center;">
				@elseif ($website['type'] == 3)
				<input type="hidden" name="type" value="3">
				<input type="text" class="text" id="mobile" name="mobile" value="" placeholder="：" style="width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/mobile.png') no-repeat left center;">
				@elseif ($website['type'] == 4)
				<input type="hidden" name="type" value="4">
				<input type="text" class="text" id="account" name="account" value="" placeholder="：{{trans('login.tip')}}" style="width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/account.png') no-repeat left center;">
				@endif
				<input id="password" type="password"  name="userpwd" placeholder="："  style="margin-bottom:0;width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/login_pwd.png') no-repeat left center;">
				<input type="text" name="code" maxlength="5" placeholder="{{trans('login.code')}}"  style="margin-top:0;width:60%;padding-left:5em;background:url('{{asset('/module/login')}}/images/code.png') no-repeat left center;">
          		<a onclick="javascript:re_captcha();" >
          			<img src="{{ route('get.captcha.login') }}/1" style="width:30%;margin-top:1em;margin-bottom:1em;"  alt="{{trans('login.code')}}" title="刷新图片"  height="40" id="c2c98f0de5a04167a9e427d883690ff6" border="0">
          		</a>
				<script>  
				  function re_captcha() {
				    $url = "{{ route('get.captcha.login') }}";
				        $url = $url + "/" + Math.random();
				        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
				  }
				</script>
				<div class="signin">
					<input type="button" id="do_action" value="登录/Login" >
				</div>
			</form>
	</div>
@endsection
