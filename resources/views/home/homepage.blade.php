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
  </style>

@endsection

<div class="home">
  <div class="position-absolute btn-container">
     @auth
       <a href="{{ route('home') }}" class="btn text-lg">Admin</a>
     @endauth

     @guest
       <a href="{{ url('/login')}}"  class="btn text-lg">Sign in</a>
     @endguest

  </div>
</div>

@endsection
