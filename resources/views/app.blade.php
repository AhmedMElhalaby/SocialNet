<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>{{ config('app.name', 'Laravel') }}</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" href="{{asset('public/img/favicon.ico')}}">

	<link rel="manifest" href="{{asset('public/img/site.webmanifest')}}">
	<link rel="apple-touch-icon" href="{{asset('public/img/icon.png')}}">
	<!-- Place favicon.ico in the root directory -->
	<link rel="stylesheet" href="{{asset('public/css/vendor/bootstrap.min.css')}}" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('public/css/vendor/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/css/vendor/animate.css')}}">
	<link rel="stylesheet" href="{{asset('public/css/vendor/hamburgers.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/css/util.css')}}">
	<link rel="stylesheet" href="{{asset('public/css/normalize.css')}}">
	<link rel="stylesheet" href="{{asset('public/css/main.css')}}">
	@yield('style')
</head>
<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Add your site or application content here -->

<div class="limiter">
	<div class="container-login100">
		<div class="wrap-main">
			@yield('content')
		</div>
	</div>
</div>



<script src="{{asset('public/js/vendor/modernizr-3.5.0.min.js')}}"></script>
<script src="{{asset('public/js/vendor/jquery-3.2.1.min.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('public/js/vendor/popper.min.js')}}" crossorigin="anonymous"></script>
<script src="{{asset('public/js/vendor/bootstrap.min.js')}}"  crossorigin="anonymous"></script>
{{--<script src="{{asset('public/js/vendor/jquery-3.3.1.slim.min.js')}}"  crossorigin="anonymous"></script>--}}
{{--<script>window.jQuery || document.write('<script src="{{asset('public/js/vendor/jquery-3.3.1.slim.min.js')}}"><\/script>')</script>--}}
<script src="{{asset('public/js/vendor/tilt.jquery.min.js')}}"></script>
<script src="{{asset('public/js/plugins.js')}}"></script>

<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<script src="{{asset('public/js/main.js')}}"></script>
@yield('script')
</body>
</html>
