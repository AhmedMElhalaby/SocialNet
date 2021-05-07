@extends('auth.layout')
@section('content')
<div class="login100-pic js-tilt" data-tilt>
	<img src="{{asset('public/img/img-01.png')}}" alt="IMG">
</div>
<form class="login100-form validate-form" role="form" method="POST" action="{{ route('register') }}">
    @csrf
	<span class="login100-form-title">Register</span>
	<div class="wrap-input100 validate-input" data-validate = "name is required">
		<input class="input100" type="text" name="name" placeholder="Full Name" value="{{ old('name') }}">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-user" aria-hidden="true"></i>
		</span>
	</div>
	<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
		<input class="input100" type="text" name="email" placeholder="E-Mail Address" value="{{ old('email') }}">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-envelope" aria-hidden="true"></i>
		</span>
	</div>
	<div class="wrap-input100 validate-input" data-validate = "password is required">
		<input class="input100" type="password" name="password" placeholder="Password">
		<span class="focus-input100"></span>
		<span class="symbol-input100">
			<i class="fa fa-lock" aria-hidden="true"></i>
		</span>
	</div>
	<div class="container-login100-form-btn">
		<button class="login100-form-btn">
			Register
		</button>
	</div>
	<div class="text-center p-t-25">
		<a class="txt2" href="{{ url('/') }}">
			Log in
			<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
		</a>
	</div>
</form>
@endsection
