@extends('layouts.app')
@section('content')
@section('styles')


  <style>
     .home {
    width: 100%;
    min-height: 100vh;
    height: 100%;
    background-color: #ffff;
    /* Set background image */
    background-image: url('/assets/img/AETERNITAS.png');
    background-size: cover;
    background-position: center;
    /* Make the background image fixed */
    background-attachment: fixed;
    position: relative;
    }
    .bg {
    width: 100%;
    height: 100;
    object-fit: cover;
    object-position: center;
    }
    .btn-container {
        left: 30%;
        bottom: 15%;
    }
     .btn {
        background-color: #0F6296;
        color: white;
        padding: 8px 20px;
        min-width: 170px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
     }
     .btn:hover {
        background-color: #1a3f57;
        animation-duration: 120ms;
        transition: ease-in-out;
        color:white;
     }
    .close{
        position: absolute;
        top: 10px;
        right:  10px;
        font-size: 1.5rem;
     }
     .account-footer p{
        color: black;
     }

     .custom-modal1 .modal-content{
        border: 0;
        background: transparent;
     }

    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1000; /* Ensure it's above other elements */
    }
  </style>

@endsection

<div class="home">
  <div class="position-absolute btn-container">
     @auth
       <a href="{{ route('home') }}" class="btn text-lg">Admin</a>
     @endauth

     @guest
     <a href="#" data-toggle="modal" data-target="#login" class="btn text-lg">Sign in</a>

     {!! Toastr::message() !!}

     <!-- Add Login Modal -->
     <div id="login" class="modal custom-modal1 fade" role="dialog">
         <div class="modal-dialog modal-dialog-centered modal-lg">
             <div class="modal-content">
                 <div class="modal-body">
                     <div class="container">
                         <div class="account-box">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                             <div class="account-wrapper">
                                 <h3 class="account-title text-black-50">Account Login</h3>
                                 <p class="account-subtitle">Access to our dashboard</p>
                                 <!-- Account Form -->
                                 <form method="POST" action="{{ route('login') }}">
                                     @csrf
                                     <div class="form-group">
                                         <label>Email</label>
                                         <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email">
                                         @error('email')
                                             <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                         @enderror
                                     </div>
                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label>Password</label>
                                            </div>
                                        </div>
                                        <div class="position-relative">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password">
                                            <span class="toggle-password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color:black;">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                     <div class="form-group">
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
                                     <div class="form-group text-center">
                                         <button class="btn btn-primary account-btn" type="submit">Login</button>
                                     </div>
                                     <div class="account-footer">
                                         <p>Don't have an account yet? <a href="#" id="openRegisterModal">Register</a></p>
                                     </div>
                                 </form>
                                 <!-- /Account Form -->
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
  
     <!-- Add Register Modal -->
     <div id="register" class="modal custom-modal1 fade" role="dialog">
         <div class="modal-dialog modal-dialog-centered modal-lg">
             <div class="modal-content">
                 <div class="modal-body">
                     <div class="container">
                         <div class="account-box">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                             <div class="account-wrapper">
                                 <h3 class="account-title text-black-50">Account Register</h3>
                                 <p class="account-subtitle">Access to our dashboard</p>

                                 <!-- Account Form -->
                                 <form method="POST" action="{{ route('register') }}">
                                     @csrf
                                     <div class="form-group">
                                         <label>Full Name</label>
                                         <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Your Name">
                                         @error('name')
                                             <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                         @enderror
                                     </div>
                                     <div class="form-group">
                                         <label>Email</label>
                                         <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Your Email">
                                         @error('email')
                                             <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                         @enderror
                                     </div>
                                     <input type="hidden" class="image" name="image" value="photo_defaults.jpg">
                                     <div class="form-group position-relative">
                                        <label>Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password">
                                        <span class="toggle-password" style="position: absolute; right: 10px; top: 70%; transform: translateY(-50%); cursor: pointer; color:black;">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group position-relative">
                                        <label>Confirm Password</label>
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                        <span class="toggle-password" style="position: absolute; right: 10px; top: 70%; transform: translateY(-50%); cursor: pointer; color:black;">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                    <div class="form-group text-center">
                                         <button class="btn btn-primary account-btn" type="submit">Register</button>
                                     </div>
                                     <div class="account-footer">
                                         <p>Already have an account? <a href="#" id="openLoginModal">Login</a></p>
                                     </div>
                                 </form>
                                 <!-- /Account Form -->
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

@section('script')
<script>
    $(document).ready(function() {
        // Function to hide modals and their backdrops
        function hideModalsAndBackdrop() {
            $('.modal').modal('hide');
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
        }

        $('#openRegisterModal').click(function() {
            $('#login').modal('hide');
            $('#login').on('hidden.bs.modal', function () {
                $('#register').modal('show');
                $('#login').off('hidden.bs.modal');
            });
        });

        $('#openLoginModal').click(function() {
            $('#register').modal('hide');
            $('#register').on('hidden.bs.modal', function () {
                $('#login').modal('show');
                $('#register').off('hidden.bs.modal');
            });
        });

        $('#register').on('hidden.bs.modal', function () {
            hideModalsAndBackdrop();
        });

        // Also ensure the login modal closes properly
        $('#login').on('hidden.bs.modal', function () {
            hideModalsAndBackdrop();
        });

        // for password-toggle-icon
        const togglePasswordIcons = document.querySelectorAll('.toggle-password');

        togglePasswordIcons.forEach(icon => {
            icon.addEventListener('click', function () {
                const input = this.previousElementSibling;
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        });
    });
</script>
@endsection

@endguest
</div>

@endsection
