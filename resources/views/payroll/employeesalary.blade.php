@extends('layouts.master')

@section('title')
 <title>Employee's Salaries</title>
@endsection

@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Employee Sallary <span id="year"></span></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sallary</li>
                    </ul>
                </div>
            </div>

            <!-- Search Filter -->
            <div class="row filter-row">
                <!-- [Include search filters here if needed] -->
            </div>
            <!-- /Search Filter -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Employee ID</th>
                                    <th>Email</th>
                                    <th>Join Date</th>
                                    <th>Pay Type</th>
                                    <th>Sallary</th>
                                    <th>Payslip</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $emp)
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="{{ url('employee/profile/'.$emp->employee_id) }}" class="avatar"><img alt="" src="{{ URL::to('/assets/images/LOGO.png') }}"></a>
                                            <a href="{{ url('employee/profile/'.$emp->employee_id) }}">{{ $emp->first_name }} {{ $emp->last_name }}<span>{{ $emp->position }}</span></a>
                                        </h2>
                                    </td>
                                    <td class="employee_id">{{ $emp->employee_id }}</td>
                                    <td hidden class="id">{{ $emp->id }}</td>
                                    <td>{{ $emp->email }}</td>
                                    <td>{{$emp->created_at}}</td>
                                    <td>Monthly</td>
                                    <td class="salary">{{ $emp->netpay }}</td>
                                    <td><a class="btn btn-sm btn-primary" href="{{ url('form/salary/view/'.$emp->id) }}" target="_blank">Generate Slip</a></td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" data-toggle="modal" class="userSalary" data-target="#edit_salary" data-id="{{ $emp->employee_id }}"><button class="btn btn-sm btn-dark">Edit</button></a>
                                            <a href="{{ url('payslip/mali/send/'.$emp->id)}}">Send Payslip via email</a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                {{--<a class="dropdown-item userSalary" href="#" data-toggle="modal" data-target="#edit_salary" data-id="{{ $emp->employee_id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a> --}}
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
        <!-- /Page Content -->

        <!-- Edit Salary Modal -->
        <div id="edit_salary" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Employee's Salary</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/salary/update') }}" method="POST">
                            @csrf
                            <input class="form-control" type="hidden" name="id" id="e_id" value="" readonly>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Employee</label>
                                        <input class="form-control" type="text" name="name" id="e_name" value='' readonly>
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Position</label>
                                        <input class="form-control" type="text" name="position" id="e_position" value='' readonly>
                                    </div>
                                    @error('position')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Employee ID</label>
                                        <input class="form-control" type="text" name="employee_id" id="e_employeeId" value='' readonly>
                                    </div>
                                    @error('employee_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone number</label>
                                        <input class="form-control" type="text" name="phone_number" id="e_phone-number" value='' readonly>
                                    </div>
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        <h4 class="text-primary">Employee Details</h4>

                            <div class="row">

                               <div class='col-sm-6'>
                                <div class="form-group">
                                    <label>Basic Pay</label>
                                    <input class="form-control" type="text" name="basic_pay" id="e_basic-pay" value="">
                                </div>
                                @error('basic_pay')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                               </div>

                             <div class='col-sm-6'>
                               <div class="form-group">
                                  <label>Per day</label>
                                  <input class="form-control" type="text" name="per_day" id="e_per_day" value="">
                               </div>

                                @error('basic_pay')
                                <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                             </div>

                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Allowance</label>
                                    <input class="form-control" type="text" name="allowance" id="e_allowance" value="">
                                 </div>

                                 @error('allowance')
                                 <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                                 </span>
                                @enderror
                             </div>

                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Monthly Pay</label>
                                    <input class="form-control" type="text" name="monthly_pay" id="e_monthly-pay" value="">
                                 </div>

                                 @error('monthly_pay')
                                 <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                                 </span>
                                @enderror
                             </div>

                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Monthly Pay</label>
                                    <input class="form-control" type="text" name="bi_monthly" id="e_bi-monthly" value="">
                                 </div>

                                 @error('bi_monthly')
                                 <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                                 </span>
                                @enderror
                             </div>

                            </div>

                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Salary Modal -->

        <!-- Delete Salary Modal -->
        <div class="modal custom-modal fade" id="delete_salary" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Salary</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/salary/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Salary Modal -->
    </div>
    <!-- /Page Wrapper -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.userSalary', function() {
                var employeeId = $(this).data('id');

                $.ajax({
                    url: '{{ url("employee/sallary") }}/' + employeeId,
                    type: 'GET',
                    success: function(response) {
                        $('#e_id').val(response.id);
                        $('#e_employeeId').val(response.employee_id);
                        $('#e_name').val(response.name);
                        $('#e_position').val(response.position);
                        $('#e_per_day').val(response.per_day);
                        $('#e_basic-pay').val(response.basic_pay);
                        $('#e_allowance').val(response.allowance);
                        $('#e_bi-monthly').val(response.bi_monthly);
                        $('#e_monthly-pay').val(response.monthly_pay);
                        $('#e_phone-number').val(response.phone_number);
                    }
                });
            });
        });
    </script>
@endsection
