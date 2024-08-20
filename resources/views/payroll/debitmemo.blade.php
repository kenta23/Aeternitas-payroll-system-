@extends('layouts.master')


@section('title')
  <title>Debit Memo</title>
@endsection

@section('style')
   <style>
         @media print {
            .no-print {
                  display: none;
               }
         }
   </style>

@endsection

@section('content')
  <div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Debit memo <span id="year"></span></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">debit memo</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        {!! Toastr::message() !!}

        <div class="row">
            <div class="rounded card col-sm-12">
             <div class="bg-white card-header">

                <div class="d-flex justify-content-between align-items-center">
                   <h4 class="text-success">Employee List</h4>

                   <!-- Sorting by Payroll Period -->
                     <form method="GET" action="{{ route('debitmemo.index') }}">
                       <select name="payrollperiod" id="payrollperiodselector" class="form-select-lg" onchange="this.form.submit()">
                           <option value="">Select Payroll Period</option>
                           @foreach($employeesPayroll as $payroll)
                               @php
                                   $startDate = \Carbon\Carbon::parse($payroll->start_date_payroll)->format('F d, Y');
                                   $endDate = \Carbon\Carbon::parse($payroll->end_date_payroll)->format('F d, Y');
                                   $payrollPeriodValue = $startDate . ' - ' . $endDate;
                               @endphp
                               <option value="{{ $payroll->start_date_payroll . ' - ' . $payroll->end_date_payroll }}" {{ $selectedPeriod == $payroll->start_date_payroll . ' - ' . $payroll->end_date_payroll ? 'selected' : '' }}>
                                   {{ $payrollPeriodValue }}
                               </option>
                           @endforeach
                       </select>
                    </form>

               </div>
             </div>

             <div class="card-body">
               <table id="dataTable" class="table table-bordered table-striped table-hover">
                   <thead>
                       <tr>
                           <th>ID NUMBER</th>
                           <th>NAME</th>
                           <th>Payroll period</th>
                           <th>NETPAY</th>
                       </tr>
                   </thead>
                   <tbody>
                       @php
                           $totalNetPay = 0;
                       @endphp
                       @forelse ($employees as $employee)
                       <tr>
                           <td>{{ $employee->employee_id }}</td>
                           <td>{{ $employee->last_name }}, {{ $employee->first_name }}</td>
                           <td>
                               @php
                                   $startDate = \Carbon\Carbon::parse($employee->start_date_payroll)->format('F d, Y');
                                   $endDate = \Carbon\Carbon::parse($employee->end_date_payroll)->format('F d, Y');
                               @endphp
                                   {{ $startDate }} - {{ $endDate }}
                           </td>
                           <td class="total">₱{{ number_format($employee->netpay, 2) }}</td>
                       </tr>
                       @php
                           $totalNetPay += $employee->netpay;
                       @endphp
                       @empty
                       <tr>
                           <td colspan="4">No Employees Available</td>
                       </tr>
                       @endforelse
                   </tbody>
               </table>

               <!-- Display Total Net Pay -->
               <div class="mt-3 net-pay">
                   <h5>Total Net Pay: ₱{{ number_format($totalNetPay, 2) }}</h5>
               </div>

             </div>
           </div>
       </div>

       <div class="btn-group btn-group-sm no-print">
        <button class="btn btn-white" style="color: green"><i class="fa fa-file-excel-o"></i><a href="/sample"> Excel</a></button>
        {{--<a href="{{ url('payslip/download/'. $employee->id) }}"><button class="btn btn-white" style="color: red"><i class="fa fa-file-pdf-o"></i> PDF</button></a>--}}
        <button onclick="window.print();" class="btn btn-secondary"><i class="fa fa-print fa-lg"></i>Print</button>
    </div>

    </div>
</div>




@section('script')
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <script>
    /*  const payrollPeriodSelector = document.getElementById('payrollperiodselector');

     async function getData () {
         const selectedPeriod = payrollPeriodSelector.value;
         try {
            const res = await axios.get('{{ route("debitmemo.index")}}', {
                 params: {
                    payrollperiod: encodeURIComponent(selectedPeriod),
                 }
            });

            //insert new data
            // Check if the response data is an array
         if (Array.isArray(res.data)) {
            updateTable(res.data);
         } else {
            console.error('Unexpected response format:', res.data);
          }
         } catch (error) {
             console.log(error);
         }
      }


function updateTable(employees) {
    const tbody = document.querySelector('#dataTable tbody');
    tbody.innerHTML = ''; // Clear existing rows

    let totalNetPay = 0;

    if (employees.length > 0) {
        employees.forEach(employee => {
            const startDate = new Date(employee.start_date_period).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
            const endDate = new Date(employee.end_date_period).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });

            const row = `<tr>
                <td>${employee.employee_id}</td>
                <td>${employee.last_name}, ${employee.first_name}</td>
                <td>${startDate} - ${endDate}</td>
                <td class="total">₱${parseFloat(employee.netpay).toFixed(2)}</td>
            </tr>`;

            tbody.insertAdjacentHTML('beforeend', row);
            totalNetPay += parseFloat(employee.netpay);
        });
    } else {
        tbody.innerHTML = '<tr><td colspan="4">No Employees Available</td></tr>';
    }

    // Update total net pay
    const totalNetPayElement = document.querySelector('.net-pay h5');
    totalNetPayElement.textContent = `Total Net Pay: ₱${totalNetPay.toFixed(2)}`;
  }


      payrollPeriodSelector.addEventListener('change', getData); */
  </script>

@endsection

@endsection
