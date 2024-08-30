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
            <div class="row text-dark font-weight-bold">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget card1">
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $employeesCount }}</h3> <span>Employees</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget card1">
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $departmentsCount }}</h3> <span>Departments</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget card1">
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-briefcase"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $positionsCount }}</h3> <span>Positions</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget card1">
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-plane"></i></span>
                            <div class="dash-widget-info">
                                <h3>1</h3> <span>On Leave</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row text-black-50">
                <div class="col-md-12">
                    <div class="card-group m-b-30">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div> <span class="d-block">New Employees</span> </div>
                                    <div> <span class="text-success">+10%</span> </div>
                                </div>
                                <h3 class="mb-3">{{ $newEmployees->count() }}</h3>
                                <div class="progress mb-2" style="height: 5px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">Overall Employees {{  $employees->count() }}</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div> <span class="d-block">Earnings</span> </div>
                                    <div> <span class="text-success">+12.5%</span> </div>
                                </div>
                                <h3 class="mb-3">$1,42,300</h3>
                                <div class="progress mb-2" style="height: 5px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">Previous Month <span class="text-muted">$1,15,852</span></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div> <span class="d-block">Expenses</span> </div>
                                    <div> <span class="text-danger">-2.8%</span> </div>
                                </div>
                                <h3 class="mb-3">$8,500</h3>
                                <div class="progress mb-2" style="height: 5px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">Previous Month <span class="text-muted">$7,500</span></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div> <span class="d-block">Profit</span> </div>
                                    <div> <span class="text-danger">-75%</span> </div>
                                </div>
                                <h3 class="mb-3">$1,12,000</h3>
                                <div class="progress mb-2" style="height: 5px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">Previous Month <span class="text-muted">$1,42,000</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <!-- Statistics Widget -->
            
            
            
        </div>
        <!-- /Page Content -->
    </div>
@endsection
