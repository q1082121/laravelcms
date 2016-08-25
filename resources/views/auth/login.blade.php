<!DOCTYPE html>
<html>	
<head>
<title>管理中心登录界面</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<meta name="keywords" content="Flat Dark Web Login Form Responsive Templates, Iphone Widget Template, Smartphone login forms,Login form, Widget Template, Responsive Templates, a Ipad 404 Templates, Flat Responsive Templates" />
<link href="{{asset('/module/login')}}/css/style.css" rel='stylesheet' type='text/css' />
<!--webfonts-->
<link href='http://fonts.useso.com/css?family=PT+Sans:400,700,400italic,700italic|Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.useso.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
<!--//webfonts-->
<script src="{{asset('/module/jquery')}}/dist/jquery.min.js"></script>
<!--layer-->
<script src="{{asset('/module/layer')}}/layer.js"></script>
</head>
<body>
<script>$(document).ready(function(c) {
	$('.close').on('click', function(c){
		$('.login-form').fadeOut('slow', function(c){
	  		$('.login-form').remove();
		});
	});	  
});
</script>
 <!--SIGN UP-->
 <h1>管理中心登录界面</h1>
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
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
					{{ csrf_field() }}
							<input type="text" class="text" id="email" name="email" value="{{ old('email') }}" >
							<div class="key">
							<input id="password" type="password"  name="password">
							</div>
					<div class="signin">
						<input type="submit" value="登录/Login" >
					</div>
			</form>
	</div>
	<div class="copy-rights">
			<p>版权信息</p>
	</div>
</body>
</html>