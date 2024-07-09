
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="soengsouy - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="soengsouy">
        <meta name="robots" content="noindex, nofollow">
        <title>Login HRMS</title>
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/logo.png') }}">
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/font-awesome.min.css') }}">
        <!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/line-awesome.min.css') }}">
        <!-- Select2 CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}">
        <!-- Datetimepicker CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
        {{-- message toastr --}}
        <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
        <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
        <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
    </head>
    <body class="account-page error-page">
        <style>    
            .invalid-feedback{
                font-size: 14px;
            }
            .navbar {
            padding: 15px;
            left: 46%;
            top: 10px;
             }
            .nav-link1 {
            color: #fff;
            font-weight: bold;
            float: right;
            font-family: Poppins;
            }
            .nav-link1:hover {
            color: #dadada;
            opacity: 90%;
            }
        </style>

        <!-- Navigation Bar -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link1" href="#about">About</a>
                </li>
                    </ul>
                </div>
            </nav>
        <!-- End of Navigation Bar -->
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
		<!-- Datetimepicker JS -->
		<script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
		<script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
		<!-- Custom JS -->
		<script src="{{ URL::to('assets/js/app.js') }}"></script>
        @yield('script')
        <!-- Footer -->
    <div class="footer">
        <p>© 2024 Aeternitas.  Privacy  Terms</p>
    </div>
    <!-- End Footer -->
    </body>
</html>