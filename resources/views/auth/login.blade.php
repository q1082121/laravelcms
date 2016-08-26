@extends('layouts.login')
@section('content')
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
@endsection