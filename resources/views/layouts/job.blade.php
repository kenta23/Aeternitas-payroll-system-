<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Jobs - HRMS admin dashboard</title>
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/favicon.png') }}">
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/font-awesome.min.css') }}">
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/line-awesome.min.css') }}">
		<!-- Datatable CSS -->
		<link rel="stylesheet" href="{{ URL::to('assets/css/dataTables.bootstrap4.min.css') }}">
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}">
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css') }}">
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
         <!--font family -->
         <link rel="preconnect" href="https://fonts.googleapis.com">
         <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
         <link
             href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
             rel="stylesheet">

		{{-- message toastr --}}
        <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
        <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
        <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
		@yield('style')
		<style>
			.error{
				color: red;
			}
		</style>

    </head>
    <body>
		<!-- Main Wrapper -->
        @yield('content')
		<!-- /Main Wrapper -->

		<!-- jQuery -->
        <script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
		<!-- Bootstrap Core JS -->
        <script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
        <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
		<!-- Slimscroll JS -->
		<script src="{{ URL::to('assets/js/jquery.slimscroll.min.js') }}"></script>
		<!-- Select2 JS -->
		<script src="{{ URL::to('assets/js/select2.min.js') }}"></script>
		<!-- Datatable JS -->
		<script src="{{ URL::to('assets/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ URL::to('assets/js/dataTables.bootstrap4.min.js') }}"></script>
		<!-- Datetimepicker JS -->
		<script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
		<script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
		<!-- validation-->
		<script src="{{ URL::to('assets/js/jquery.validate.js') }}"></script>
		<!-- Custom JS -->
		<script src="{{ URL::to('assets/js/app.js') }}"></script>
		@yield('script')
    </body>
</html>
