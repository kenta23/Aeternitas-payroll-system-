@extends('layouts.master');


@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Employee Details <span id="year"></span></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Employee details</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- /Page Header -->
        {!! Toastr::message() !!}


        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" style="width: 100%">
                    <table class="table table-striped custom-table mb-0" id="dataTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th class="text-center">Employee ID</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Gender</th>
                                <th>Birthday</th>
                                <th>Address</th>
                                <th>Emergency Contact Name</th>
                                <th>Emergency Contact No.</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($employees as $emp)
                             <tr>
                                <td>{{ $emp->id }}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="{{ url('employee/details/edit/'.$emp->id) }}" class="avatar"><img alt="employee avatar" src="{{ URL::to('/assets/img/employee_avatar.png') }}"></a>
                                        <a href="{{ url('employee/details/edit/'.$emp->id) }}">{{ $emp->first_name }} {{ $emp->last_name }} 
                                            @if ($emp->separation_date)
                                            <span class="text-danger">Resigned</span>
                                           @else
                                            <span>{{ $emp->position }}</span>
                                           @endif
                                        </a>
                                    </h2>
                                </td>

                                <td class="employee_id">{{ $emp->employee_id }}</td>
                                <td>{{ $emp->email }}</td>
                                <td>{{ $emp->phone_number }}</td>
                                <td>{{ $emp->sex }}</td>
                                <td>{{ $emp->birth_date}}</td>
                                <td>{{ $emp->current_address }}</td>
                                <td>{{ $emp->emergency_name }}</td>
                                <td>{{ $emp->emergency_phonenumber }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item " href="{{ url('employee/details/edit/'.$emp->id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item salaryDelete" href="#" data-toggle="modal" data-target="#delete_salary"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
  </div>



  @section('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  @endsection

@endsection
