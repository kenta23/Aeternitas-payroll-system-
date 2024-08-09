@extends('layouts.master');

@section('title')
   <title>
        Employees Contributions
   </title>
@endsection


@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employees Contributions and Taxes<span id="year"></span></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Contributions and Taxes</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- /Page Header -->

            {!! Toastr::message() !!}

             <!-- Search Filter -->
        <form action="{{ route('employee/search/tax-and-contribution') }}" method="POST">
            @csrf
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" name="employee_id">
                        <label class="focus-label">Employee ID</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" id="name" name="name" class="form-control floating">
                        <label class="focus-label">Employee Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" id="position" name="position" class="form-control floating">
                        <label class="focus-label">Position</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="submit" class="btn btn-success btn-block"> Search </button>
                </div>
            </div>
        </form>
        <!-- Search Filter -->


            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0 datatable" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th class="text-center">Employee ID</th>
                                    <th>SSS No</th>
                                    <th class="text-center">Philhealth</th>
                                    <th>Pagibig</th>
                                    <th>TIN</th>
                                    <th>Tax</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($employees as $emp)
                                 <tr>
                                    <td>{{ $emp->id }}</td>

                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="{{ url('employee/profile/'.$emp->employee_id) }}" class="avatar"><img alt="" src="{{ URL::to('/assets/images/LOGO.png') }}"></a>
                                            <a href="{{ url('employee/profile/'.$emp->employee_id) }}">{{ $emp->first_name }} {{ $emp->last_name }}<span>{{ $emp->position }}</span></a>
                                        </h2>
                                    </td>

                                    <td class="employee_id">{{ $emp->employee_id }}</td>
                                    <td>{{ $emp->sss_number }}</td>
                                    <td>{{$emp->philhealth_number}}</td>
                                    <td>{{$emp->pagibig_number}}</td>
                                    <td>{{ $emp->tin_number }}</td>
                                    <td>{{ $emp->tax }}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="" href=" {{ url('employees/edit/contributions/'.$emp->employee_id) }}" data-id="{{ $emp->employee_id }}"><i class="fa fa-pencil m-r-5"></i>Edit</a>
                                                <a href="" href="{{ url('') }}">View Slip</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>


        @section('script')
                  <script>

                  </script>
        @endsection
@endsection
