<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ URL::asset('public/images/favicon.jpg') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | FMR</title>
    <!-- Custom fonts for this template-->
    <link href="{{ URL::asset('public/css/css.css') }}" rel="stylesheet">
    <!--link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"-->

    <!-- Styles -->
    <link href="{{ URL::asset('public/admin/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/css/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/css/tokeninput/token-input.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!}
        ;
    </script>
</head>