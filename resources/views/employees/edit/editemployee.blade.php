@extends('layouts.master')

@section('title')
  <title>Edit Employees</title>
@endsection

@section('content')
    @section('style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
    <!-- checkbox style -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/checkbox-style.css') }}">
    @endsection
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee View</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee View Edit</li>
                        </ul>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Employee edit</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('all/employee/update') }}" method="POST">
                                @csrf
                                <input type="text" class="form-control" id="id" name="id" value="{{ $employees[0]->id }}" readonly>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Employee ID</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ $employees[0]->employee_id }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2 mb-2">First name</label>
                                    <div class="col-md-10 mb-2">
                                        <input type="text" class="form-control" id="first_name" name="firstname" value="{{ $employees[0]->first_name }}">
                                    </div>

                                    <label class="col-form-label col-md-2 mb-2">Middle name</label>
                                    <div class="col-md-10 mb-2">
                                        <input type="text" placeholder="Optional" class="form-control" id="middlename" name="middle_name" value="{{ $employees[0]->middle_name }}">
                                    </div>

                                    <label class="col-form-label col-md-2 mb-2">Last name</label>
                                    <div class="col-md-10 mb-2">
                                        <input type="text" class="form-control" id="last_name" name="lastname" value="{{ $employees[0]->last_name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Email</label>
                                    <div class="col-md-10">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $employees[0]->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Birth Date</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control datetimepicker" id="birth_date" name="birthdate" value="{{ $employees[0]->birth_date }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Sex</label>
                                    <div class="col-md-10">
                                        <select class="select form-control" id="sex" name="sex">
                                            <option value="{{ $employees[0]->sex }}" {{ ( $employees[0]->sex == $employees[0]->sex) ? 'selected' : '' }}>{{ $employees[0]->sex }} </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Current Address</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $employees[0]->current_address }}">
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label class="col-form-label col-md-2">Phone Number</label>
                                     <div class="input-group col-md-10">
                                            <span class="input-group-text">+63</span>
                                            <input type="text" id="phone_number" name="phone_number" value="{{ ($employees[0]->phone_number) }}" class="form-control" placeholder="Enter 10 digit phone number Ex. 9123456789">
                                      </div>
                                 </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Position</label>
                                    <div class="col-md-10">
                                        <select class="select form-control" id="position" name="position">
                                            <option value="{{ $employees[0]->position }}" {{ ( $employees[0]->position == $employees[0]->position) ? 'selected' : '' }}>{{ $employees[0]->position }} </option>
                                            @foreach ($position as $pos)
                                                <option value="{{ $pos->position }}">{{ $pos->position }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Department</label>
                                    <div class="col-md-10">
                                        <select class="select form-control @error('department') is-invalid @enderror" style="width: 100%;" id="department" name="department_id">
                                            <option value="">-- Select --</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}" {{ $employees[0]->department_id == $department->id ? 'selected' : '' }} >
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('department')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">SSS no</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="sss_number" name="sss_number" value="{{ $employees[0]->sss_number }}">
                                    </div>
                                        @error('sss_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Philhealth</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="philhealth_number" name="philhealth" value="{{ $employees[0]->philhealth_number }}">
                                        </div>
                                            @error('philhealth_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Pagibig</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" id="pagibig_number" name="pagibig_number" value="{{ $employees[0]->pagibig_number }}">
                                            </div>

                                                @error('pagibig_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                         </div>

                                         <div class="form-group row">
                                            <label class="col-form-label col-md-2">TIN no</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" id="tin_number" name="tin_number" value="{{ $employees[0]->tin_number }}">
                                            </div>

                                                @error('tin_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                         </div>

                                         <div class="card-header">
                                            <h4 class="card-title mb-0">Summary details</h4>
                                         </div>


                                     <div class="row mt-4">
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Monthly Pay (₱)</label>

                                                <input type="number" class="form-control @error('monthly_pay') is-invalid @enderror" id="monthly_pay" name="monthly_pay" value="{{ $employees[0]->monthly_pay }}">

                                            @error('monthly_pay')
                                             <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                            @enderror
                                            </div>

                                        </div>


                                        <div class="col-sm-6">
                                            <div>
                                                <label class="col-form-label">Monthly Allowance (₱)</label>
                                                <input type="number" id="allowance" name="allowance" value="{{ $employees[0]->allowance }}" class="form-control" step="0.01" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Total Monthly (₱)</label>
                                                <input type="number" id="total_monthly" name="total_monthly" class="form-control" readonly>
                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Bi-Monthly Rate (₱)</label>
                                                <input type="number" id="bi_monthly" name="bi_monthly" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Equivalent Daily Rate (₱)</label>
                                                <input type="number" id="daily_rate" name="daily_rate" class="form-control" readonly>
                                            </div>
                                        </div>

                                     </div>
                                </div>



                                <div class="form-group row">
                                    <label class="col-form-label col-md-2"></label>
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-primary col-md-4 submit-btn" id="updateBtn">Update</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

@section('script')
    <script>
        $("input:checkbox").on('click', function()
        {
            var $box = $(this);
            if ($box.is(":checked"))
            {
                var group = "input:checkbox[class='" + $box.attr("class") + "']";
                $(group).prop("checked", false);
                $box.prop("checked", true);
            }
            else
            {
                $box.prop("checked", false);
            }
        });
    </script>

<script>
   const sss_number = document.getElementById('sss_number');
   const philhealth_number = document.getElementById('philhealth_number');
   const phoneNumber = document.getElementById('phone_number');

   function phoneNumberFormat() {

    let phoneNumberInput = phoneNumber.value;

    phoneNumberInput = phoneNumberInput.replace(/\D/g, '');

    if (phoneNumberInput.length > 10) {
        phoneNumberInput = phoneNumberInput.substring(0, 10);
     }

     phoneNumber.value = phoneNumberInput;
  }

   function sssNumberFormat() {
       let sssNumberInput = sss_number.value;

       // Remove non-digit characters
       sssNumberInput = sssNumberInput.replace(/\D/g, '');

        if (sssNumberInput.length > 2) {
            sssNumberInput = sssNumberInput.substring(0, 2) + '-' + sssNumberInput.substring(2);
        }
        if (sssNumberInput.length > 9) {
            sssNumberInput = sssNumberInput.substring(0, 10) + '-' + sssNumberInput.substring(9, 10);
        }

        sss_number.value =  sssNumberInput;
   }
   function philhealthNumberFormat() {
       let philhealthNumberInput = philhealth_number.value;
       // Remove non-digit characters
       philhealthNumberInput = philhealthNumberInput.replace(/\D/g, '');

        if (philhealthNumberInput.length > 2) {
           philhealthNumberInput = philhealthNumberInput.substring(0, 2) + '-' + philhealthNumberInput.substring(2);
        }
        if (philhealthNumberInput.length > 9) {
            philhealthNumberInput = philhealthNumberInput.substring(0, 12) + '-' + philhealthNumberInput.substring(11, 12);
        }

        philhealth_number.value =  philhealthNumberInput;
   }

    sss_number.addEventListener('input', sssNumberFormat);
    philhealth_number.addEventListener('input', philhealthNumberFormat);
    phoneNumber.addEventListener('input', phoneNumberFormat);

  </script>


  <script>
     //Calculate and display total monthly and bi-monthly totals
        const monthlyPayInput = document.getElementById('monthly_pay');
        const allowanceInput = document.getElementById('allowance');
        const totalMonthlyInput = document.getElementById('total_monthly');
        const biMonthlyInput = document.getElementById('bi_monthly');
        const dailyRateInput = document.getElementById('daily_rate');


    function calculateTotals() {
        const monthlyPay = parseFloat(monthlyPayInput.value) || 0;
        const allowance = parseFloat(allowanceInput.value) || 0;

        if (monthlyPay || allowance) {
            const totalMonthly = monthlyPay + allowance;
            const biMonthlyTotal = monthlyPay / 2;
            const dailyRate = (monthlyPay * 12) / 313;

            totalMonthlyInput.value = totalMonthly.toFixed(2);
            biMonthlyInput.value = biMonthlyTotal.toFixed(2);
            dailyRateInput.value = dailyRate.toFixed(2);
        }

        console.log('MONTHLY PAY', monthlyPay);
        console.log('ALLOWANCE', allowance);
    }

       // Initial calculation on page load
     window.onload = function () {
        calculateTotals();
    };

     //addEventListener Function
     monthlyPayInput.addEventListener('input', function() {
              console.log('Monthly Pay changed:', monthlyPayInput.value);
              calculateTotals();
    });
     allowanceInput.addEventListener('input', calculateTotals);

  </script>

  @endsection

@endsection
