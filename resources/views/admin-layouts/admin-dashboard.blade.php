<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include ('admin-layouts.head')
<body id="page-top">
	<div id="wrapper">
		@include ('admin-layouts.admin-sidebar')
		<!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
				@include ('admin-layouts.admin-top-header')
				@yield('content')
			</div>
		<!-- End of Main Content -->
	</div>
	<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
@include ('admin-layouts.modals')
@include ('admin-layouts.scripts')
</body>
</html>