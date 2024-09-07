@extends('layouts.master')
@section('title')
 <title>Dashboard</title>
@endsection

@section('content')
    <?php
        $hour   = date ("G");
        $minute = date ("i");
        $second = date ("s");
        $msg = " Today is " . date ("l, M. d, Y.");

        if ($hour == 00 && $hour <= 9 && $minute <= 59 && $second <= 59) {
            $greet = "Good Morning,";
        } else if ($hour >= 10 && $hour <= 11 && $minute <= 59 && $second <= 59) {
            $greet = "Good Day,";
        } else if ($hour >= 12 && $hour <= 15 && $minute <= 59 && $second <= 59) {
            $greet = "Good Afternoon,";
        } else if ($hour >= 16 && $hour <= 23 && $minute <= 59 && $second <= 59) {
            $greet = "Good Evening,";
        } else {
            $greet = "Welcome,";
        }
    ?>
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">{{ $greet }} {{ Session::get('name') }}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            {!! Toastr::message() !!}

            <div class="row text-dark font-weight-bold">
                <div class="col-md-6 col-sm-6 col-lg-6 ">
                    <div class="card dash-widget card1">
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $employeesCount }}</h3> <span>Employees</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 ">
                    <div class="card dash-widget card1">
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $departmentsCount }}</h3> <span>Departments</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6">
                    <div class="card dash-widget card1">
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-briefcase"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $positionsCount }}</h3> <span>Positions</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 ">
                    <div class="card dash-widget card1">
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-plane"></i></span>
                            <div class="dash-widget-info">
                                <h3>1</h3> <span>On Leave</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- message --}}

            <!-- Statistics Widget -->

        </div>
        <!-- /Page Content -->
    </div>
@endsection
