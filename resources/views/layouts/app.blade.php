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



	<!-- Styles -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
    <link href="{{ URL::asset('public/css/jquery-ui.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('public/css/style.css') }}" rel="stylesheet">

</head>

<body>

	@yield('content')

	<!-- Bootstrap core JavaScript-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script src="{{ URL::asset('public/js/jquery-ui.js') }}"></script>
	
	<script src="{{ URL::asset('public/js/main.js') }}"></script>

</body>

</html>

