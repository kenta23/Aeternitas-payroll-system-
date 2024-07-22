@extends('layouts.master')
@section('style')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
<!-- checkbox style -->
<link rel="stylesheet" href="{{ URL::to('assets/css/checkbox-style.css') }}">
@endsection

@section('title')
    <title>Time keeping</title>
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
                    <h3 class="page-title">Timekeeping <span id="year"></span></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Timekeeping</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- /Page Header -->

        {!! Toastr::message() !!}

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
                                <th>Regular Work Days</th>
                                <th>Absences</th>
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
                                <td>{{$emp->regular_worked_days}}</td>
                                <td class="salary">{{ $emp->absences }}</td>

                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item userSalary" href="#" data-toggle="modal" data-target="#edit_employee" data-id="{{ $emp->employee_id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
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


    <!-- Edit Salary Modal -->
    <div id="edit_employee" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Timekeeping</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('employee/timekeeping/update')}}" method="POST">
                        @csrf
                        <input class="form-control" type="hidden" name="id" id="id" value="" readonly>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Employee</label>
                                    <input class="form-control" type="text" name="name" id="name" value='' readonly>
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
                                    <input class="form-control" type="text" name="position" id="position" value='' readonly>
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
                                    <input class="form-control" type="text" name="employee_id" id="employee_id" value='' readonly>
                                </div>
                                @error('employee_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Daily rate</label>
                                    <input class="form-control" type="number" step="0.01" name="daily_rate" id="daily_rate" value=''>
                                </div>

                                @error('daily_rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                 <div class="row">
                         <div class='col-sm-6'>
                            <h4 class="text-primary">Regular worked days</h4>
                            <div class="form-group">
                                <label>No. of regular worked days</label>
                                <input class="form-control" type="number" step="0.01" name="regular_worked_days" id="regular_worked_days" value="13">
                            </div>
                            @error('regular_worked_days')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror

                            <div class="form-group">
                                <label>Absences</label>
                                <input class="form-control" step="0.01" type="number" name="absences" id="absences" value="">
                            </div>
                            @error('absences')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror

                            <div class="form-group">
                                <label>Month rate paid days</label>
                                <input class="form-control" type="text" name="month_rate_paid_days" readonly id="month_rate_paid_days" value="13">
                            </div>

                        </div>


                     <div class="col-sm-6">
                            <h4 class="text-primary">Legal worked days</h4>
                             <div class="form-group">
                                <label>Legal Holiday Worked Days</label>
                                <input class="form-control" type="text" name="legal_worked_days" id="legal_worked_days" value="">
                             </div>

                             <div class="form-group">
                                <label>Total amount</label>
                                <input class="form-control" type="text" name="lhd_amount" id="lhd_amount" value="">
                             </div>

                             @error('lhd_amount')
                             <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                             </span>
                            @enderror
                     </div>

                     <div class="col-sm-6">
                        <h4 class="text-primary">Special Worked Days</h4>

                        <div class="form-group">
                            <label>Special work days rate</label>
                            <input class="form-control" type="text" name="special_rate" id="special_rate" value="">
                        </div>

                        <div class="form-group">
                            <label>Special work total amount</label>
                            <input class="form-control" type="text" name="special_amount" id="special_amount" value="">
                        </div>
                     </div>

                     <div class="col-sm-6">
                        <h4 class="text-primary">Leave</h4>

                        <div class="form-group">
                            <label>Special work days rate</label>
                            <input class="form-control" type="text" name="lhw_days" id="lhw_days" value="">
                        </div>

                        <div class="form-group">
                            <label>Special work total amount</label>
                            <input class="form-control" type="text" name="special_amount" id="special_amount" value="">
                        </div>
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
  </div>

  @section('script')
   <script>
      $(document).ready(function() {
          $(document).on('click', '.userSalary', function() {
              const employeeId = $(this).data('id');

              $.ajax({
                  url: '{{ url("employee/timekeeping/edit") }}/' + employeeId,
                  type: 'GET',
                  success: function(response) {
                      $('#employee_id').val(response.employee_id);
                      $('#daily_rate').val(response.daily_rate);
                      $('#name').val(response.name);
                      $('#position').val(response.position);
                      $('#regular_worked_days').val(response.regular_worked_days);
                      $('#absences').val(response.absences);
                      $('#legal_worked_days').val(response.legal_worked_days);
                      $('#lhd_amount').val(response.lhd_amount);
                      $('#special_rate').val(response.special_rate);
                      $('#special_amount').val(response.special_amount);
                  }
              });
          });
      });
  </script>

  <script>
     const regularWorkDaysInput = document.getElementById('regular_worked_days');
     const absencesInput = document.getElementById('absences');
     let regularDaysTotal = parseFloat(regularWorkDaysInput.value) || 0;
     const legalWorkedDaysInput = document.getElementById('legal_worked_days');
     const lhdAmountInput = document.getElementById('lhd_amount');
     let lhdAmountValue = parseFloat(lhdAmountInput.value) || 0;
     const dailyRate = document.getElementById('daily_rate');


    function calculateRegularDays () {
        if (regularWorkDaysInput && absencesInput) {
            const absences = parseFloat(absencesInput.value) || 0;
            const total = regularDaysTotal - absences;

            regularWorkDaysInput.value = total.toFixed(2);
        }
    };

    function calculateTotalAmountLWD () {
         const parsedDailyRate = parseFloat(dailyRate.value) || 0;
         const legalWorkedDaysValue = parseFloat(legalWorkedDaysInput.value) || 0;

        if (!isNaN(parsedDailyRate) && legalWorkedDaysValue)
        {
           const totalLhdValue = legalWorkedDaysValue * parsedDailyRate;
           lhdAmountInput.value = totalLhdValue.toFixed(2);
        } else {
           lhdAmountInput.value = '0.00';
        }

        console.log('daily rate', parsedDailyRate);

        }

    window.onload = function() {
        regularDaysTotal = parseFloat(regularWorkDaysInput.value) || 0;
        calculateRegularDays();
        calculateTotalAmountLWD();
    }

    absencesInput.addEventListener('input', calculateRegularDays);
    legalWorkedDaysInput.addEventListener('input', calculateTotalAmountLWD);

  </script>

 @endsection
@endsection
