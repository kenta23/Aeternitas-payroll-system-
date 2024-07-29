@extends('layouts.master')


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
                    <table class="table table-striped custom-table mb-0 datatable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th class="text-center">Employee ID</th>
                                <th>Email</th>
                                <th class="text-center">Join Date</th>
                                <th>Regular Work Days</th>
                                <th>Absences</th>
                                <th>Actual days worked</th>
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
                                <td>{{ $emp->email }}</td>
                                <td>{{$emp->created_at}}</td>
                                <td>{{$emp->regular_worked_days}}</td>
                                <td>{{ $emp->absences }}</td>
                                <td>{{ $emp->actual_days_worked}}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item employeeInfo" href="#" data-toggle="modal" data-target="#edit_employee" data-id="{{ $emp->employee_id }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
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
                <!--NAV TABS -->
                <ul class="nav nav-pills w-100 nav-fill" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="working-days-tab" data-bs-toggle="tab" data-bs-target="#working-days" type="button" role="tab" aria-controls="working-days" aria-selected="true">Working days</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="overtime-tab" data-bs-toggle="tab" data-bs-target="#overtime" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false">Overtime</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="night-differential-tab" data-bs-toggle="tab" data-bs-target="#timekeeping-tab-pane" type="button" role="tab" aria-controls="timekeeping-tab-pane" aria-selected="false">Night Differential</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="lates-tab" data-bs-toggle="tab" data-bs-target="#timekeeping-tab-pane" type="button" role="tab" aria-controls="timekeeping-tab-pane" aria-selected="false">Lates</button>
                    </li>
                </ul>

             <form action="{{ route('employee/timekeeping/update')}}" method="POST">
                 @csrf
                <div class="tab-content">
                    <div class="p-3 border tab-pane fade show active" id="working-days" role="tabpanel" aria-labelledby="working-days-tab">
                        <!-- Content for Working Days -->
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
                                    <input class="form-control" type="number" readonly step="0.01" name="regular_worked_days" id="regular_worked_days" value="13">
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
                                    <label>Monthly rate paid days</label>
                                    <input class="form-control" type="text" name="month_rate_paid_days" readonly id="month_rate_paid_days" value="13">
                                </div>

                            </div>


                        <!--LEGAL WORKED DAYS -->
                         <div class="col-sm-6">
                                <h4 class="text-primary">Legal worked days</h4>
                                 <div class="form-group">
                                    <label>Legal Holiday Worked Days</label>
                                    <input class="form-control" type="text" name="legal_worked_days" id="legal_worked_days" value="">
                                 </div>

                                 <div class="form-group">
                                    <label>Total amount</label>
                                    <input class="form-control" type="text" name="lhd_amount" readonly id="lhd_amount" value="">
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
                </div>


                     <div class="p-3 border tab-pane fade" id="overtime" role="tabpanel" aria-labelledby="overtime-tab">

                         <div class="row">

                            <div class="col-sm-6">
                                <h4 class="text-primary">Regular Overtime Rate 25%</h4>

                                <div class="form-group">
                                    <label for="ot_rate25">OT Rate</label>
                                    <input class="form-control" type="number" step="0.01" name="ot_rate25" id="ot_rate25" value="" disabled>

                                    <label for="ot_hours25">OT Hours</label>
                                    <input class="form-control" type="number" id="ot_hours25" name="ot_hours25" value="">

                                    @error('ot_hours25')
                                      <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror

                                    <label for="ot_amount25">OT Amount</label>
                                    <input class="form-control" type="number" id="ot_amount25" name="ot_amount25" value="" step="0.01">

                                    @error('ot_amount25')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror

                                 </div>
                         </div>


                         <div class="col-sm-6">
                            <h4 class="text-primary">Special Overtime Rate 30%</h4>

                            <div class="form-group">
                                <label for="ot_rate30">OT Rate</label>
                                <input class="form-control" type="number" name="ot_rate30" id="ot_rate30" value="" readonly>

                                <label for="ot_hours30">OT Hours</label>
                                <input class="form-control" type="number" id="ot_hours30" name="ot_hours30" value="">

                                @error('ot_hours30')
                                  <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                                  </span>
                                @enderror

                                <label for="ot_amount30">OT Amount</label>
                                <input class="form-control" type="number" id="ot_amount30" name="ot_amount30" value="" step="0.01">

                                @error('ot_amount30')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                   </span>
                                @enderror

                            </div>
                       </div>


                      <div class="col-sm-6">
                        <h4 class="text-primary">Legal Overtime Rate 100%</h4>

                        <div class="form-group">
                            <label for="ot_rate100">OT Rate</label>
                            <input class="form-control" type="number" name="ot_rate100" id="ot_rate100" value="" readonly>

                            <label for="ot_hours100">OT Hours</label>
                            <input class="form-control" type="number" id="ot_hours100" name="ot_hours100" value="">

                            @error('ot_hours100')
                              <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                              </span>
                            @enderror

                            <label for="ot_amount100">OT Amount</label>
                            <input class="form-control" type="number" id="ot_amount100" name="ot_amount100" value="0" step="0.01">

                            @error('ot_amount100')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                               </span>
                            @enderror
                         </div>
                      </div>


                      <div class="col-sm-6 align-items-center my-auto">
                          <label for="total_ot">Total OT amount</label>
                          <input type="number" id="total_ot" name="total_ot" value="" readonly class="form-control">
                      </div>

                     </div>
                   </div>

                     <div class="submit-section modal-footer">
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
          $(document).on('click', '.employeeInfo', function() {
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

                      //overtime
                      $('#ot_rate25').val(response.ot_rate25);
                      $('#ot_hours25').val(response.ot_hours25);
                      $('#ot_amount25').val(response.ot_amount25);

                      $('#ot_rate30').val(response.ot_rate30);
                      $('#ot_hours30').val(response.ot_hours30);
                      $('#ot_amount30').val(response.ot_amount30);

                      $('#ot_rate100').val(response.ot_rate100);
                      $('#ot_hours100').val(response.ot_hours100);
                      $('#ot_amount100').val(response.ot_amount100);
                      $('#total_ot').val(response.total_ot);
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

     //overtime
     const otRate25 = document.getElementById('ot_rate25');
     const otHours25 = document.getElementById('ot_hours25');
     const otAmount25 = document.getElementById('ot_amount25');
     const totalOt = document.getElementById('total_ot');

     //special ot rate
     const otRate30 = document.getElementById('ot_rate30');
     const otHours30 = document.getElementById('ot_hours30');
     const otAmount30 = document.getElementById('ot_amount30');

     //legal ot rate
     const otRate100 = document.getElementById('ot_rate100');
     const otHours100 = document.getElementById('ot_hours100');
     const otAmount100 = document.getElementById('ot_amount100');



 function calculateAllOTs() {
    const otRate25Value = parseFloat(otRate25.value) || 0;
    const otRate30Value = parseFloat(otRate30.value) || 0;
    const otRate100Value = parseFloat(otRate100.value) || 0;

    if (otHours25 && otRate25Value) {
        const parsedOtHours25 = parseFloat(otHours25.value) || 0;
        const totalOt25Amount = otRate25Value * parsedOtHours25;
        otAmount25.value = totalOt25Amount.toFixed(2);
    }

    if (otHours30 && otRate30Value) {
        const parsedOtHours30 = parseFloat(otHours30.value) || 0;
        const totalOt30Amount = otRate30Value * parsedOtHours30;
        otAmount30.value = totalOt30Amount.toFixed(2);
    }

    if (otHours100 && otRate100Value) {
        const parsedOtHours100 = parseFloat(otHours100.value) || 0;
        const totalOt100Amount = otRate100Value * parsedOtHours100;
        otAmount100.value = totalOt100Amount.toFixed(2);
    }

    const otAmount25Value = parseFloat(otAmount25.value) || 0;
    const otAmount30Value = parseFloat(otAmount30.value) || 0;
    const otAmount100Value = parseFloat(otAmount100.value) || 0;

    if (!isNaN(otAmount25Value) && !isNaN(otAmount30Value) && !isNaN(otAmount100Value)) {
         const total = otAmount25Value + otAmount30Value + otAmount100Value;
         totalOt.value = total.toFixed(2);
    }
}



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
        calculateAllOTs();
    }

    absencesInput.addEventListener('input', calculateRegularDays);
    legalWorkedDaysInput.addEventListener('input', calculateTotalAmountLWD);

    otHours25.addEventListener('input', calculateAllOTs);
    otHours30.addEventListener('input', calculateAllOTs);
    otHours100.addEventListener('input', calculateAllOTs);

    calculateAllOTs();

  </script>
 @endsection
@endsection
