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
                    <table class="table table-striped custom-table mb-0 datatable" style="width:100%;">
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
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Timekeeping</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                <!--NAV TABS -->
                <ul class="nav nav-tabs w-100 nav-fill" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="working-days-tab" data-bs-toggle="tab" data-bs-target="#working-days" type="button" role="tab" aria-controls="working-days" aria-selected="true">Working days</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="overtime-tab" data-bs-toggle="tab" data-bs-target="#overtime" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false">Overtime</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="night-differential-tab" data-bs-toggle="tab" data-bs-target="#night-differential" type="button" role="tab" aria-controls="night-differential" aria-selected="false">Night Differential</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="leave-tab" data-bs-toggle="tab" data-bs-target="#leave" type="button" role="tab" aria-controls="leave-tab-pane" aria-selected="false">Leave</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="late-deduction-tab" data-bs-toggle="tab" data-bs-target="#late-deduction" type="button" role="tab" aria-controls="late-deduction-tab-pane" aria-selected="false">Late Deduction</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="allowance-tab" data-bs-toggle="tab" data-bs-target="#allowance" type="button" role="tab" aria-controls="allowance-tab-pane" aria-selected="false">Allowance</button>
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


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Bi Monthly</label>
                                        <input class="form-control" type="number" step="0.01" name="bi_monthly" id="bi_monthly" value='' readonly>
                                    </div>
                                </div>
                            </div>



                      <div class="row">
                             <div class='col-sm-6'>
                                <h4 class="text-primary">Regular worked days</h4>
                                <div class="form-group">
                                    <label>No. of actual days worked</label>
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
                                <label>SNH rate</label>
                                <input class="form-control" type="number" name="special_rate" id="special_rate" value="" readonly>
                            </div>

                            <div class="form-group">
                                <label>Special Worked Days</label>
                                <input class="form-control" type="number" step="0.01" name="special_worked_days" id="special_worked_days" value="">
                            </div>

                            <div class="form-group">
                                <label>Special work total amount</label>
                                <input class="form-control" type="number" name="special_amount" id="special_amount" value="" readonly>
                            </div>
                         </div>


                         <div class="col-sm-6">
                            <h4 class="text-primary">Total amounts</h4>

                            <div class="form-group">
                                <label>Basic Pay</label>
                                <input class="form-control" type="number" name="basic_pay" id="basic_pay" step="0.01" value="" readonly>
                            </div>

                            <div class="form-group">
                                <label>Basic Pay + OT </label>
                                <input class="form-control" type="number" name="basic_pay_plus_ot" id="basic_pay_plus_ot" step="0.01" value="" readonly>
                            </div>

                            <div class="form-group">
                                <label>Total Worked Days</label>
                                <input type="number" id="total_worked_days" name="total_worked_days" value="" step="0.01" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label>Regular work days amount</label>
                                <input class="form-control" type="number" name="rwd_amount" id="rwd_amount" step="0.01" value="" readonly>
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
                                    <input class="form-control" type="number" step="0.01" name="ot_rate25" id="ot_rate25" value="" readonly>

                                    <label for="ot_hours25">OT Hours</label>
                                    <input class="form-control" type="number" id="ot_hours25" name="ot_hours25" value="">

                                    @error('ot_hours25')
                                      <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror

                                    <label for="ot_amount25">OT Amount</label>
                                    <input class="form-control" type="number" id="ot_amount25" name="ot_amount25" value="" step="0.01" readonly>

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
                                <input class="form-control" type="number" id="ot_hours30" name="ot_hours30" value="" step="0.01">

                                @error('ot_hours30')
                                  <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                                  </span>
                                @enderror

                                <label for="ot_amount30">OT Amount</label>
                                <input class="form-control" type="number" id="ot_amount30" name="ot_amount30" value="" step="0.01" readonly>

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
                            <input class="form-control" type="number" id="ot_amount100" name="ot_amount100" value="0" step="0.01" readonly>

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


                   <!--NIGHT DIFFERENTIAL -->

                   <div class="p-3 border tab-pane fade" id="night-differential" role="tabpanel" aria-labelledby="night-differential-tab">
                         <div class="row">
                              <div class="col-sm-12">
                                  <label for="nd_rate">10% OF Rate/Hour (₱)</label>
                                  <input type="number" class="form-control" id="nd_rate" name="nd_rate" readonly>


                                  <label for="nd_hours">ND Hours</label>
                                  <input type="number" class="form-control" id="nd_hours" name="nd_hours" step="0.01">


                                  <label for="nd_amount">ND Amount</label>
                                  <input type="number" class="form-control" id="nd_amount" name="nd_amount" readonly>
                              </div>
                          </div>

                   </div>

                   <!--LEAVE-->
                   <div class="p-3 border tab-pane fade" id="leave" role="tabpanel" aria-labelledby="leave-tab">
                             <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="leave_dailyrate">Daily Rate (₱)</label>
                                        <input type="number" class="form-control" id="leave_dailyrate" name="leave_dailyrate" readonly value="" step="0.01">
                                    </div>
                                  </div>


                                  <div class="col-sm-6">
                                       <div class="form-group">
                                         <label for="credit_points">Credit Points</label>
                                         <input type="number" class="form-control" id="credit_points" name="credit_points" step="0.01">
                                       </div>
                                  </div>

                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="used_credit">Used (current cut off)</label>
                                        <input type="number" class="form-control" id="used_credit" name="used_credit" step="0.01">
                                    </div>
                                  </div>

                             <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="leave_amount">Leave amount (₱)</label>
                                        <input type="number" class="form-control" id="leave_amount" name="leave_amount" step="0.01" readonly>
                                    </div>
                             </div>
                        </div>
                   </div>

                   <!--LATE DEDUCTION -->

                   <div class="p-3 border tab-pane fade" id="late-deduction" role="tabpanel" aria-labelledby="late-deduction-tab">
                      <div class="row">
                          <div class="col-sm-12">
                               <div class="form-group">
                                  <label for="deduction_rate">Rate/Min (₱)</label>
                                  <input type="number" class="form-control" id="deduction_rate" name="deduction_rate" step="0.01" readonly>

                                  <label for="no_of_minutes">Number Of Minutes</label>
                                  <input type="number" class="form-control" id="no_of_minutes" name="no_of_minutes" step="0.01">

                                  <label for="late_amount">Amount (₱)</label>
                                  <input type="number" class="form-control" id="late_amount" name="late_amount" step="0.01" readonly>

                                  <label for="late_charges">Charges (₱) <span class="text-primary text-sm">Missing/Loss Item Note: Please Input 0 if none or Existing data to recalculate the Total Charge!</span></label>
                                  <input type="number" class="form-control" id="late_charges" name="late_charges" step="0.01">

                               </div>
                          </div>
                      </div>
                   </div>


                   <div class="p-3 border tab-pane fade" id="allowance" role="tabpanel" aria-labelledby="allowance-tab">
                      <div class="row">
                           <div class="col-sm-12">
                               <div class="form-group">
                                    <label for="allowance">Allowance (₱)</label>
                                    <input type="number" step="0.01" class="form-control" id="allowance" name="allowance" value="">


                                    <label for="meal">Meal (₱)</label>
                                    <input type="number" step="0.01" class="form-control" id="meal" name="meal" value="">
                               </div>
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
                      $('#id').val(response.id)
                      $('#employee_id').val(response.employee_id);
                      $('#daily_rate').val(response.daily_rate);
                      $('#leave_dailyrate').val(response.daily_rate);
                      $('#name').val(response.name);
                      $('#position').val(response.position);
                      $('#regular_worked_days').val(response.regular_worked_days);
                      $('#absences').val(response.absences);
                      $('#legal_worked_days').val(response.legal_worked_days);
                      $('#lhd_amount').val(response.lhd_amount);
                      $('#special_rate').val(response.special_rate);
                      $('#special_amount').val(response.special_amount);
                      $('#bi_monthly').val(response.bi_monthly);

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

                      //lates
                      $('#deduction_rate').val(response.late_rate);

                      //night differential
                      $('#nd_rate').val(response.night_differential);
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
     //const lhdAmountInput = document.getElementById('lhd_amount');
     const basicPayPlusOt = document.getElementById('basic_pay_plus_ot');

     const dailyRate = document.getElementById('daily_rate');
     const basicPay = document.getElementById('basic_pay');
     const biMonthly = document.getElementById('bi_monthly');
     const monthRatePaidDays = document.getElementById('month_rate_paid_days');
     const totalWorkedDays = document.getElementById('total_worked_days');


     //allowance
     const allowance = document.getElementById('allowance');
     const meal = document.getElementById('meal');


     //for basic pay
     const specialAmount = document.getElementById('special_amount');
     const lhdAmount = document.getElementById('lhd_amount');
     let lhdAmountValue = parseFloat(lhdAmount.value) || 0;
     const rwdAmount = document.getElementById('rwd_amount');


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


     //SPECIAL DAYS
     const specialRate =  document.getElementById('special_rate');
     const specialWorkedDays = document.getElementById('special_worked_days');
     const specialTotalAmount = document.getElementById('special_amount');

     //NIGHT DIFFERENTIAL
     const ndRate = document.getElementById('nd_rate');
     const ndHours = document.getElementById('nd_hours');
     const ndAmount = document.getElementById('nd_amount');

     //LEAVE
     const usedCurrentCutOff = document.getElementById('used_credit');
     const leaveAmount = document.getElementById('leave_amount');
     const leaveDailyRate = document.getElementById('leave_dailyrate');

     //Lates
     const lateAmount = document.getElementById('late_amount');
     const numberOfMinutes = document.getElementById('no_of_minutes');
     const deductionRate = document.getElementById('deduction_rate');


     //Calculate Leave
     function calculateLeaveAmount() {
        const parsedDailyRateInLeave = parseFloat(leaveDailyRate.value) || 0;
        const parsedUsedCurrentCutOff = parseFloat(usedCurrentCutOff.value) || 0;

        if (parsedDailyRateInLeave && parsedUsedCurrentCutOff) {
            const leaveAmountVal = parsedDailyRateInLeave * parsedUsedCurrentCutOff;

            leaveAmount.value = leaveAmountVal.toFixed(2);

            calculateRwdAmount();
        }
    }

    //calculate Basic Pay
    function calculateBasicPay () {
         const parsedLegalDays = parseFloat(lhdAmount.value) || 0;
         const parsedSpecialDays = parseFloat(specialAmount.value) || 0;
         const parsedRegularDays = parseFloat(rwdAmount.value) || 0;

       if (parsedLegalDays && parsedRegularDays && parsedRegularDays) {
            const totalBasicPay = parsedLegalDays + parsedSpecialDays + parsedRegularDays;

            basicPay.value = totalBasicPay.toFixed(2);
       }
    }

    //calculate total worked days
    // Total worked days
    function calculateTotalWorkedDays() {
    // Parse the values from input fields
    const parsedRegularWorkedDays = parseFloat(regularWorkDaysInput.value) || 0;
    const parsedLegalWorkedDays = parseFloat(legalWorkedDaysInput.value) || 0;
    const parsedSpecialWorkedDays = parseFloat(specialWorkedDays.value) || 0;

    // Sum up all valid worked days
    const totalWorkedDays = parsedRegularWorkedDays + parsedLegalWorkedDays + parsedSpecialWorkedDays;
    document.getElementById('total_worked_days').value = totalWorkedDays.toFixed(2);
}


    //calculate basic pay Plus ot
    function calculateBasicPayPlusOT () {
        const totalBasicPay = parseFloat(basicPay.value) || 0;
        const parsedTotalOT = parseFloat(totalOt.value) || 0;

        console.log('total ot ', parsedTotalOT);

       if(totalBasicPay && parsedTotalOT) {
          const totalBasicPayPlusOT = totalBasicPay + parsedTotalOT;
          basicPayPlusOt.value = totalBasicPayPlusOT.toFixed(2);
       }

    }

    //calculate RWD Amount
    function calculateRwdAmount () {
        const parsedBiMonthlyRate = parseFloat(biMonthly.value) || 0;
        const parsedLeaveAmount = parseFloat(leaveAmount.value) || 0;
        const parsedMonthRatePaidDays = parseFloat(monthRatePaidDays.value) || 0;
        const regularWorkedDays = parseFloat(regularWorkDaysInput.value);
        const parseduUsedCurrentCutOff = parseFloat(usedCurrentCutOff.value) || 0;

        const parsedDailyRate = parseFloat(dailyRate.value) || 0;

        console.log('values', [
            parsedBiMonthlyRate, parsedLeaveAmount, parsedMonthRatePaidDays, regularWorkedDays, parseduUsedCurrentCutOff, parsedDailyRate
        ])


        if (parsedBiMonthlyRate || parsedLeaveAmount || parsedMonthRatePaidDays || regularWorkedDays || parseduUsedCurrentCutOff || parsedDailyRate) {
            const finalAmount = (parsedBiMonthlyRate - parsedLeaveAmount) - ( (parsedMonthRatePaidDays - regularWorkedDays - parseduUsedCurrentCutOff) * parsedDailyRate);

            rwdAmount.value = finalAmount.toFixed(2);

            calculateBasicPay();
        }
    }


    // Calculate late rate and late amount
    function calculateLateRate() {
        const parsedDailyRateInLates = parseFloat(deductionRate.value) || 0;

        const parsedLateAmount = parseFloat(lateAmount.value) || 0;
        const parsedNumberOfMinutes = parseInt(numberOfMinutes.value) || 0;

        if (numberOfMinutes) {
            lateAmount.value = (parsedDailyRateInLates * parsedNumberOfMinutes).toFixed(2);
        }
    }


     function calculateNightDifferential () {
         const parsedNdRate = parseFloat(nd_rate.value) || 0;

         if(ndHours) {
             const parsedNdHours = parseFloat(ndHours.value) || 0;
             const totalNd = parsedNdRate * parsedNdHours;

             ndAmount.value = totalNd.toFixed(2);
         }
     }


  function calculateSpecialWorkingDays() {
       //calculate first the special rate
       const parsedDailyRate = parseFloat(dailyRate.value) || 0;
       const totalSpecialRate =  parsedDailyRate * 0.3;

       if(specialWorkedDays && specialRate) {
           const parsedSpecialWorkedDays = parseFloat(specialWorkedDays.value) || 0;

           specialTotalAmount.value = (totalSpecialRate * parsedSpecialWorkedDays).toFixed(2);

           calculateBasicPay();
       }
           specialRate.value = totalSpecialRate.toFixed(2);
   }

  /* function calculateBasicPay() {
         //rwd amount
         //lhd amount
         //special amount
   }


   function calculateRwdAmount() {
       //bimonthly
       const parsedBiMonthly = parseFloat(biMonthly.value) || 0;
       //leave amount
       //month rate paid days
       //regular worked days
       //used current cut off
   } */


 function calculateAllOTs() {
    const otRate25Value = parseFloat(otRate25.value) || 0;
    const otRate30Value = parseFloat(otRate30.value) || 0;
    const otRate100Value = parseFloat(otRate100.value) || 0;

    console.log('OT should computed')

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

         calculateBasicPayPlusOT();
    }
     calculateTotalWorkedDays();

  }

    function calculateRegularDays () {
        if (regularWorkDaysInput && absencesInput) {
            const absences = parseFloat(absencesInput.value) || 0;
            let total = regularDaysTotal - absences;

            if(total < 0) {
                total = 0;
            }

            regularWorkDaysInput.value = total.toFixed(2);

            calculateRwdAmount();
            calculateBasicPay();
        }
    };

    function calculateTotalAmountLWD () {
         const parsedDailyRate = parseFloat(dailyRate.value) || 0;
         const legalWorkedDaysValue = parseFloat(legalWorkedDaysInput.value) || 0;

        if (!isNaN(parsedDailyRate) && legalWorkedDaysValue)
        {
           const totalLhdValue = legalWorkedDaysValue * parsedDailyRate;
           lhdAmount.value = totalLhdValue.toFixed(2);

           calculateBasicPay();

        } else {
            lhdAmount.value = '0.00';
        }

        console.log('daily rate', parsedDailyRate);

        }

    window.onload = function() {
        regularDaysTotal = parseFloat(regularWorkDaysInput.value) || 0;

        calculateRegularDays();
        calculateTotalAmountLWD();
        calculateAllOTs();
        calculateSpecialWorkingDays();
        calculateNightDifferential();
        calculateLeaveAmount();
        calculateLateRate();
        calculateRwdAmount();
        calculateBasicPay();
        calculateBasicPayPlusOT();
        calculateTotalWorkedDays();
    }

    document.addEventListener('DOMContentLoaded', () => {
        regularDaysTotal = parseFloat(regularWorkDaysInput.value) || 0;

       calculateRegularDays();
       calculateTotalAmountLWD();
       calculateAllOTs();
       calculateSpecialWorkingDays();
       calculateNightDifferential();
       calculateLeaveAmount();
       calculateLateRate();
       calculateRwdAmount();
       calculateBasicPay();
       calculateBasicPayPlusOT();
       calculateTotalWorkedDays();
    })

    absencesInput.addEventListener('input', calculateRegularDays);
    legalWorkedDaysInput.addEventListener('input', calculateTotalAmountLWD);

    otHours25.addEventListener('input', calculateAllOTs);
    otHours30.addEventListener('input', calculateAllOTs);
    otHours100.addEventListener('input', calculateAllOTs);
    specialWorkedDays.addEventListener('input', calculateSpecialWorkingDays);
    ndHours.addEventListener('input', calculateNightDifferential);
    usedCurrentCutOff.addEventListener('input', calculateLeaveAmount);
    numberOfMinutes.addEventListener('input', calculateLateRate);
    biMonthly.addEventListener('input', calculateRwdAmount);

  </script>
 @endsection
@endsection
