@extends('layouts.app')
@section('content')


    <div class="main-wrapper">
        <div class="main-content">
                  <!-- Account Logo -->
                  <div class="account-logo">
                    <img class="image-logo" src="{{ URL::to('assets/img/LOGO (1).png') }}" alt="aeternitas">
                </div>
                {{-- message --}}
                {!! Toastr::message() !!}
            <!-- /Account Logo -->

            <div class="container">
                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">Forgot Password</h3>
                        <p class="account-subtitle">Input your email send you a reset password link.</p>
                        <!-- Account Form -->
                        <form method="POST" action="/forget-password">
                            @csrf
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" type="submit">SEND</button>
                            </div>
                            <div class="account-footer text-primary">
                                <a href="{{ route('home') }}">Go back to home</a>
                            </div>
                        </form>
                        <!-- /Account Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
