@extends('layouts.app')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <div class="login-main-wrapper">
        <div class="login-account-content">
            {{-- <a href="{{ route('form/job/list') }}" class="btn btn-primary apply-btn">Apply Job</a> --}}
        <div class="login-container">
                <button class="btn btn-primary" id="loginButton" data-toggle="modal" data-target="#loginModal" >Login</button>

  <!-- login Modal -->
  <div id="loginModal" class="loginModal">
    <div class="login_Container">
    {{-- message --}}
    {!! Toastr::message() !!}
    <!-- /Account Logo -->
<div class="login-account-box">
    <span class="loginClose">&times;</span> <!-- Close button -->
    <div class="login-account-wrapper">
        <h3 class="login-account-title">Login</h3>
            <p class="login-account-subtitle">Access to our dashboard</p>
    <!-- Account Form -->
<form id="loginForm" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="login-form-group">
        <label>Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </span>
            </div>
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email">
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="login-form-group">
        <div class="row">
            <div class="col">
                <label>Password</label>
            </div>
        </div>
        <div class="input-group">
            <div class="input-group-append">
                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password">
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>    
    <div class="login-form-group">
        <div class="row">
            <div class="col">
                <label></label>
            </div>
            <div class="col-auto">
                <a class="text-muted" href="{{ route('forget-password') }}">
                    Forgot password?
                </a>
            </div>
        </div>
    </div>
    <div class="login-form-group text-center">
        <button class="btn btn-primary login-account-btn" type="submit">Login</button>
    </div>
    <div class="login-account-footer">
        <p>Don't have an account yet? <a href="{{ route('register', ['showModal' => 'true']) }}">Register</a></p>
    </div>
</form>
<!-- /Account Form -->
</div>
</div>
</div>
</div>
<!-- End of modal -->

</div>
</div>
</div>


@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // JavaScript to close the modal when clicking the &times; button
    $(document).ready(function() {
        $('.loginModal .loginClose').click(function() {
            $('#loginModal').modal('hide');
        });
    document.getElementById('togglePassword').addEventListener('click', function (e) {
        // toggle the type attribute
        const password = document.getElementById('password');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye icon
        this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    });
    });
    
</script>