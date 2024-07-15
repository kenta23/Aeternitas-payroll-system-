
@extends('layouts.master')
@section('content')
@section('style')
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
   <style>

    </style>
@endsection
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="grid row gap-3">
                    <div class="col-sm-12">
                        <h3 class="page-title">Attendance</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Attendance</li>
                        </ul>
                    </div>

                    <div class="col-sm-12 mt-4">
                        <div>
                             <h3 class="font-semibold">{{ $currentDate }}</h3>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /Page Header -->


        {{-- message --}}
       {!! Toastr::message() !!}

            <!--ADD ATTENDANCE -->
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_attendance"><i class="fa fa-plus"></i> Add Attendance</a>
<!-- Add Attendance -->
<div id="add_attendance" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="attendance" action="{{ route('attendance/add') }}"  method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Employee name:</label>
                                <select class="select form-control @error('employee') is-invalid @enderror" style="width: 100%;" id="employee" name="employee">
                                    <option value="">-- Select --</option>
                                    @foreach ($employees as $e)
                                        <option value="{{ $e->employee_id }}" {{ old('employee_id') == $e->employee_id ? 'selected' : '' }}>{{ $e->first_name . ' ' . $e->last_name }}</option>
                                    @endforeach
                                </select>

                                @error('employee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Time in</label>
                                <select class="select form-control @error('time-in') is-invalid @enderror" style="width: 100%;" id="time-in" name="time-in">
                                    <option value="">-- Select --</option>

                                        <option value="{{ $currentTime }}" {{ old('time-in') == $currentTime ? 'selected' : '' }}>{{ $currentTime }}</option>
                                </select>

                                @error('time-in')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Time out</label>
                                <input class="form-control
                                @error('time-out') is-invalid @enderror" type="time" id="time-out" name="time-out" value="{{ old('time-out') }}">

                                @error('time-out')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
            <!--ADD ATTENDANCE -->
            <div class="row mt-md-5">
                <div class="col-md-4">
                    <div class="card punch-status">
                        <div class="card-body">
                            <h5 class="card-title">Timesheet <small class="text-muted">11 Mar 2019</small></h5>
                            <div class="punch-det">
                                <h6>Punch In at</h6>
                                <p>Wed, 11th Mar 2019 10.00 AM</p>
                            </div>
                            <div class="punch-info">
                                <div class="punch-hours">
                                    <span>3.45 hrs</span>
                                </div>
                            </div>
                            <div class="punch-btn-section">
                                <button type="button" class="btn btn-primary punch-btn">Punch Out</button>
                            </div>
                            <div class="statistics">
                                <div class="row">
                                    <div class="col-md-6 col-6 text-center">
                                        <div class="stats-box">
                                            <p>Break</p>
                                            <h6>1.21 hrs</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6 text-center">
                                        <div class="stats-box">
                                            <p>Overtime</p>
                                            <h6>3 hrs</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card att-statistics">
                        <div class="card-body">
                            <h5 class="card-title">Statistics</h5>
                            <div class="stats-list">
                                <div class="stats-info">
                                    <p>Today <strong>3.45 <small>/ 8 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>This Week <strong>28 <small>/ 40 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>This Month <strong>90 <small>/ 160 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Remaining <strong>90 <small>/ 160 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Overtime <strong>4</strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card recent-activity">
                        <div class="card-body">
                            <h5 class="card-title">Today Activity</h5>
                            <ul class="res-activity-list">
                                <li>
                                    <p class="mb-0">Punch In at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        10.00 AM.
                                    </p>
                                </li>
                                <li>
                                    <p class="mb-0">Punch Out at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        11.00 AM.
                                    </p>
                                </li>
                                <li>
                                    <p class="mb-0">Punch In at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        11.15 AM.
                                    </p>
                                </li>
                                <li>
                                    <p class="mb-0">Punch Out at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        1.30 PM.
                                    </p>
                                </li>
                                <li>
                                    <p class="mb-0">Punch In at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        2.00 PM.
                                    </p>
                                </li>
                                <li>
                                    <p class="mb-0">Punch Out at</p>
                                    <p class="res-activity-time">
                                        <i class="fa fa-clock-o"></i>
                                        7.30 PM.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-3">
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <input type="text" class="form-control floating datetimepicker">
                        </div>
                        <label class="focus-label">Date</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option>-</option>
                            <option>Jan</option>
                            <option>Feb</option>
                            <option>Mar</option>
                            <option>Apr</option>
                            <option>May</option>
                            <option>Jun</option>
                            <option>Jul</option>
                            <option>Aug</option>
                            <option>Sep</option>
                            <option>Oct</option>
                            <option>Nov</option>
                            <option>Dec</option>
                        </select>
                        <label class="focus-label">Select Month</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating">
                            <option>-</option>
                            <option>2019</option>
                            <option>2018</option>
                            <option>2017</option>
                            <option>2016</option>
                            <option>2015</option>
                        </select>
                        <label class="focus-label">Select Year</label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <a href="#" class="btn btn-success btn-block"> Search </a>
                </div>
            </div>
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>In</th>
                                    <th>Out</th>
                                    <th>Production</th>
                                    <th>Break</th>
                                    <th>Overtime</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($attendances as $a)
                                       <td>{{$a->employee_id }}</td>
                                       <td>{{$a->created_at}}</td>
                                       <td>{{$a->name}}</td>
                                       <td>{{$a->time_in}}</td>
                                       <td>{{$a->time_out}}</td>
                                       <td>0</td>
                                       <td>0</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        </div>
        <!-- /Page Content -->


    </div>
    <!-- /Page Wrapper -->

    @section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var employeeSelect = document.getElementById('employee');
            var hiddenEmployeeId = document.getElementById('employee_id');

            // Update hidden field when the page loads, in case of form repopulation
            if (employeeSelect.value) {
                hiddenEmployeeId.value = employeeSelect.value;
            }

            // Add event listener to update hidden input on change
            employeeSelect.addEventListener('change', function () {
                hiddenEmployeeId.value = this.value;
            });
        });
    </script>

    @endsection

@endsection
