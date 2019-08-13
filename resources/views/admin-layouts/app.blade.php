<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title') | FMR</title>
	<!-- Custom fonts for this template-->
	<link href="{{ URL::asset('public/admin/css/css.css') }}" rel="stylesheet">

	<!-- Styles -->
	<link href="{{ URL::asset('public/admin/css/all.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('public/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('public/admin/css/style.css') }}" rel="stylesheet">
</head>
<body>
	@yield('content')
	<!-- Bootstrap core JavaScript-->
	<script src="{{ URL::asset('public/admin/js/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('public/admin/js/bootstrap.bundle.min.js') }}"></script>
	<!-- Core plugin JavaScript-->
	<script src="{{ URL::asset('public/admin/js/jquery.easing.min.js') }}"></script>
	<!-- Custom scripts for all pages-->
	<script src="{{ URL::asset('public/admin/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
