<!DOCTYPE html>
<html>	
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>{{ $website['title'] }}-{{trans('admin.website_name')}}-{{trans('admin.website_type')}}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<meta name="keywords" content="{{$website['root']['syskeywords']}}" >
<meta name="description" content="{{$website['root']['sysdescription']}}" >
<link rel="shortcut icon" href="/favicon.ico" >
<link href="{{asset('/module/login/css/style.css')}}" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="{{ elixir('css/login.css') }}">
<!--webfonts
<link href='http://fonts.useso.com/css?family=PT+Sans:400,700,400italic,700italic|Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.useso.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
-->
<!--//webfonts-->
<script src="{{asset('/module/jquery/dist/jquery.min.js')}}"></script>
<!--layer-->
<script src="{{asset('/module/layer/layer.js')}}"></script>
<!--common-->
<script src="{{ elixir('js/login.js') }}"></script>
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
	@yield('content')
	<div class="copy-rights">
			<p>{{ $website['copyrights'] }}</p>
	</div>
</body>
</html>