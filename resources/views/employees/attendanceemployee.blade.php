
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
                        <div class="col-sm-12">
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
                                <label for="time_in" class="col-form-label">Time In</label>
                                <select class="select form-control @error('time_in') is-invalid @enderror" style="width: 100%;" id="time_in" name="time_in">
                                    <option value="">-- Select --</option>
                                    <option value="{{ $currentTime }}" {{ old('time_in') == $currentTime ? 'selected' : '' }}>{{ $currentTime }}</option>
                                </select>
                                @error('time_in')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>



                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for='time_out' class="col-form-label">Time out</label>
                                    <input class="form-control
                                    @error('time_out') is-invalid @enderror" type="time" id="time_out" name="time_out" value="{{ old('time-_out') }}">

                                    @error('time_out')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                         </div>


                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Overtime</label>
                                <input class="form-control
                                @error('overtime') is-invalid @enderror" type="number" id="overtime" name="overtime" value="{{ old('overtime') }}">

                                @error('overtime')
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



     <!-- Search Filter -->
            <div class="row filter-row mt-4">
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
                                @foreach ($attendances as $a)
                                    <tr>
                                       <td>{{$a->employee_id }}</td>
                                       <td>{{$a->created_at}}</td>
                                       <td>{{$a->name}}</td>
                                       <td>{{$a->time_in}}</td>
                                       <td>{{$a->time_out}}</td>
                                       <td>0</td>
                                       <td>1</td>
                                       <td>{{$a->overtime}}</td>
                                    </tr>
                                 @endforeach
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
