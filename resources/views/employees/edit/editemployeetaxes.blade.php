@extends('layouts.master')

@section('title')
  <title>Edit Employee Contributions and Taxes</title>
@endsection

@section('style')
   <style>
        .nav-link {
           border: none;
        }
        .navtab-parent {

        }
        .btn-navtabs {
            width: 100%;
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
                    <h3 class="page-title">Edit Employee Contribution and Taxes<span id="year"></span></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Edit</a></li>
                        <li class="breadcrumb-item active">Contributions and Taxes</li>
                    </ul>
                </div>
            </div>
        </div>

         <!-- NAV TABS -->
<ul class="nav nav-pills nav-justified navtab-parent" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active btn-navtabs"  id="sss_tab" data-bs-toggle="tab" data-bs-target="#sss-pane" type="button" role="tab" aria-controls="sss-pane" aria-selected="true">SSS</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link btn-navtabs"   id="taxes-tab" data-bs-toggle="tab" data-bs-target="#taxes-pane" type="button" role="tab" aria-controls="taxes-pane" aria-selected="false">Taxes</button>
    </li>

    <!-- <li class="nav-item" role="presentation">
        <button class="nav-link btn-navtabs"   id="philhealth_tab" data-bs-toggle="tab" data-bs-target="#philhealth-pane" type="button" role="tab" aria-controls="philhealth-pane" aria-selected="false">Philhealth</button>
    </li>

   <li class="nav-item" role="presentation">
        <button class="nav-link btn-navtabs"   id="pagibig-tab" data-bs-toggle="tab" data-bs-target="#pagibig-pane" type="button" role="tab" aria-controls="pagibig-pane" aria-selected="false">Pag ibig</button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link btn-navtabs"   id="taxes-tab" data-bs-toggle="tab" data-bs-target="#taxes-pane" type="button" role="tab" aria-controls="taxes-pane" aria-selected="false">Taxes</button>
    </li> -->
</ul>

{!! Toastr::message() !!}


<!-- TAB CONTENT -->
<form method="POST" action="{{ url('employee/taxes/'.$employee->id)}}" class="">
    @csrf
  <div class="tab-content">
    <div class="p-3 border tab-pane fade show active" id="sss-pane" role="tabpanel" aria-labelledby="sss_tab">
        <h2 class="text-success">SSS - PHILHEALTH - PAG-IBIG - LOANS</h2> <hr>

        <div class="row mb-6">
            <div class="col-md-6">
                <label> <b> Loan</b></label> <br>
                <label> Employee Purchase</label>
                <input type="number" id="employee_purchase" name="employee_purchase" value="{{ $employee->employee_purchase }}" class="form-control">
                <label> CASH advance </label>
                <input type="number" id="cash_advance" name="cash_advance" value="{{ $employee->cash_advance }}"  class="form-control">
                <label> Uniforms </label>
                <input type="number" id="uniform" name="uniform" value="{{ $employee->uniform }}" class="form-control">

                <hr>

                <label> SSS Loan (₱)</label>
                <input type="number" id="sss_loan" name="sss_loan" value="{{ $employee->sss_loan }}" class="form-control" >

                <label> Pag-Ibig Loan (₱)</label>
                <input type="number" id="hdmf_loan" name="hdmf_loan" value="{{ $employee->hdmf_loan }}" class="form-control" >

                <hr>

                <label> Missing charges (₱)</label>
                <input type="number" id="missing_charges" name="missing_charges" value="{{ $employee->missing_charges }}" class="form-control" step="0.01" readonly>


            </div>

            <div class="col-md-6">
                <label> <b> SSS - Prem. Contribution</b></label> <br>

                <label> EMPLOYEE</label>
                <input type="number" id="employee_sss_premcontribution" name="employee_sss_premcontribution" value="{{ $employee->sss_premcontribution}}" class="form-control" >
                <label> EMPLOYEER</label>
                <input type="number" id="employer_sss_premcontribution" step="0.01" name="employer_sss_premcontribution" value="{{ $employee->employer_sss_premcontribution }}" class="form-control" >

                <hr>

                <label> <b> SSS - WISP</b></label> <br>

                <label> EMPLOYEE</label>
                <input type="number" id="employee_sss_wisp" name="employee_sss_wisp" value="{{ $employee->sss_wisp }}" class="form-control">

                <label> EMPLOYEER</label>
                <input type="number" id="employer_sss_wisp" step="0.01" name="employer_sss_wisp" value="{{ $employee->employer_sss_wisp }}" class="form-control" >

                <hr>

                <label> <b> PHILHEALTH</b></label> <br>

                <label for="employee_phic">EMPLOYEE</label>
                <input type="number" id="employee_phic" step="0.01" name="employee_phic" value="{{ $employee->phic }}" class="form-control" >

                <label> EMPLOYEER</label>
                <input type="number" id="employer_phic" step="0.01" name="employer_phic" value="{{ $employee->employer_phic }}" class="form-control" >

                <hr>

                <label> <b> HDMF</b></label> <br>

                <label> EMPLOYEE</label>
                <input type="number" id="employee_hdmf" name="employee_hdmf" value="{{ $employee->hdmf }}" class="form-control" >
                <label> EMPLOYEER</label>
                <input type="number" id="employer_hdmf" step="0.01" name="employer_hdmf" value="{{ $employee->employer_hdmf }}" class="form-control" >

                <hr>
            </div>

        </div>
    </div>

    <div class="p-3 border tab-pane fade" id="taxes-pane" role="tabpanel" aria-labelledby="taxes-tab">
        <h2 class="text-success">Taxes</h2> <hr>

        <div class="row">
            <div class="col-md-6">
                <label>Monthly Sallary</label>
                <input type="number" id="monthly" name="monthly" value="{{ $employee->monthly_pay}}" class="form-control" readonly>

                <label>SSS Prem. Contribution</label>
                <input type="number" id="tax_sss_premcontribution" name="tax_sss_premcontribution" value="{{ $employee->tax_sss_premcontribution }}" class="form-control" readonly>

                <label>SSS WISP</label>
                <input type="number" id="tax_sss_wisp" name="tax_sss_wisp" value="{{ $employee->tax_sss_wisp }}" class="form-control" readonly>

                <label>PHIC Contribution</label>
                <input type="number" id="tax_phic" name="tax_phic" value="{{ $employee->tax_phic }}" class="form-control" readonly>

                <label>PAG-IBIG Contribution</label>
                <input type="number" id="tax_hdmf" name="tax_hdmf" value="{{ $employee->tax_hdmf }}" class="form-control" readonly>

                <label>Total Remittance</label>
                <input type="number" id="total_remittance" name="total_remittance" value="{{ $employee->totalremittance }}" class="form-control" readonly>

                <label>Taxable Income</label>
                <input type="number" id="taxable_income" name="taxable_income" value="{{ $employee->taxable_income }}" class="form-control" readonly>
            </div>

            <div class="col-md-6">
                <label>CL <i class="text text-danger">Enter 0 if none</i></label>
                <input type="number" id="tax_cl" name="tax_cl" value="{{ $employee->tax_cl }}" class="form-control" >

                <label>Excess</label>
                <input type="number" id="tax_excess" name="tax_excess" value="{{ $employee->tax_excess }}" class="form-control" readonly>

                <label>Tax Rate (ex. 15 = 15%)</label>
                <input type="number" id="tax_rate_percentage" name="tax_rate_percentage" step="0.01" value="{{ $employee->tax_rate_percentage }}" class="form-control" >

                <input type="number" id="tax_rate" name="tax_rate" step="0.01" value="{{ $employee->tax_rate }}" class="form-control" readonly>

                <label>Fixed Rate</label>
                <input type="number" id="fixed_rate" name="fixed_rate" step="0.01" value="{{ $employee->fixed_rate }}" class="form-control" >

                <label>WHTax/month</label>
                <input type="number" id="tax_month" name="tax_month" step="0.01" value="{{ $employee->tax_month }}" class="form-control" readonly>

                <label>WHTax/cut-off</label>
                <input type="number" id="tax_cutoff" name="tax_cutoff" step="0.01" value="{{ $employee->tax_cutoff }}" class="form-control" readonly>
            </div>


            <div class="col-sm-6">
                <label> Total Deductions (₱)</label>
                <input type="number" id="total_deduction" name="total_deduction" step="0.01" value="{{ $employee->total_deduction }}" class="form-control" readonly>

                <label> TAX (₱)</label>
                <input type="number" id="tax" name="tax" value="{{ $employee->tax }}" class="form-control" readonly>

            </div>

            <div class="col-sm-6">
                <label> Gross Pay (₱)</label>
                <input type="number" id="grosspay" name="grosspay" step="0.01" value="{{ $employee->gross_pay }}" class="form-control" readonly>

                <label> Net Pay (₱)</label>
                <input type="number" id="netpay" name="netpay" step="0.01" value="{{ $employee->netpay }}" class="form-control" readonly>
            </div>
        </div>
      </div>
   </div>

  <div class="submit-section">
    <button type="submit" class="btn btn-primary submit-btn">Update</button>
  </div>

</form>

    </div>
  </div>

  @section('script')
  <script>
     const employeePurchase = document.getElementById('employee_purchase');
     const cashAdvance = document.getElementById('cash_advance');
     const uniform = document.getElementById('uniform');
     const sssLoan = document.getElementById('sss_loan');
     const hdmfLoan = document.getElementById('hdmf_loan');
     const otherDeduction = document.getElementById('other_deduction');
     const employeeSssPremContribution = document.getElementById('employee_sss_premcontribution');
     const employerSssPremContribution = document.getElementById('employer_sss_premcontribution');
     const employeeSssWisp = document.getElementById('employee_sss_wisp');
     const employerSssWisp = document.getElementById('employer_sss_wisp');
     const employeePhic = document.getElementById('employee_phic');
     const employerPhic = document.getElementById('employer_phic');
     const employeeHdmf = document.getElementById('employee_hdmf');
     const employerHdmf = document.getElementById('employer_hdmf');
     const tax = document.getElementById('tax');
     const totalDeduction = document.getElementById('total_deduction');
     const monthlySalary = document.getElementById('monthly');
     const taxSssPremContribution = document.getElementById('tax_sss_premcontribution');
     const taxSssWisp = document.getElementById('tax_sss_wisp');
     const taxPhic = document.getElementById('tax_phic');
     const taxHdmf = document.getElementById('tax_hdmf');
     const totalRemittance = document.getElementById('total_remittance');
     const taxableIncome = document.getElementById('taxable_income');
     const taxCl = document.getElementById('tax_cl');
     const taxExcess = document.getElementById('tax_excess');
     const taxRatePercentage = document.getElementById('tax_rate_percentage');
     const taxRate = document.getElementById('tax_rate');
     const fixedRate = document.getElementById('fixed_rate');
     const taxMonth = document.getElementById('tax_month');
     const taxCutoff = document.getElementById('tax_cutoff');
     const netPay = document.getElementById('netpay');
     const grossPay = document.getElementById('grosspay');



  function showSSSpremContribution () {
      const parsedEmployeeSss = parseFloat(employeeSssPremContribution.value) || 0;

      if(parsedEmployeeSss) {
        taxSssPremContribution.value = ( parsedEmployeeSss * 2 ).toFixed(2);

      }

      calculateTotalRemittance();
  }

  function showSSSWISP () {
      const parsedEmployeeSSSwisp = parseFloat(employeeSssWisp.value) || 0;

      if(parsedEmployeeSSSwisp) {
        taxSssWisp.value = (parsedEmployeeSSSwisp * 2).toFixed(2);

      }

      calculateTotalRemittance();
  }


  function showPhicContribution () {
      const parsedEmployeePhic = parseFloat(employeePhic.value) || 0;

      if(parsedEmployeePhic) {
        taxPhic.value = (parsedEmployeePhic * 2).toFixed(2);

      }

      calculateTotalRemittance();
  }

  function showHdmfContribution () {
      const parsedEmployeeHdmf = parseFloat(employeeHdmf.value) || 0;

      if(parsedEmployeeHdmf) {
        taxHdmf.value = (parsedEmployeeHdmf * 2).toFixed(2);

      }

      calculateTotalRemittance();
  }

  //CALCULATE TOTAL REMITTANCE
  function calculateTotalRemittance () {
    const parsedTaxSssemployee = parseFloat(taxSssPremContribution.value) || 0;
    const parsedTaxSssWisp = parseFloat(taxSssWisp.value) || 0;
    const parsedTaxPhic = parseFloat(taxPhic.value) || 0;
    const parsedTaxEmployeeHdmf = parseFloat(taxHdmf.value) || 0;

    if(parsedTaxSssemployee || parsedTaxSssWisp || parsedTaxPhic || parsedTaxEmployeeHdmf) {
       // const total = doubledSSS + doubledPhic + doubledSssWisp + doubledHdmf;
        const total = parsedTaxSssemployee + parsedTaxSssWisp + parsedTaxPhic  + parsedTaxEmployeeHdmf;

        totalRemittance.value = total.toFixed(2);
    }

    calculateTaxableIncome();

  }

  //calculate taxable income
  function calculateTaxableIncome () {
      const parsedMonthlyPay = parseFloat(monthlySalary.value) || 0;
      const parsedTotalRemittance = parseFloat(totalRemittance.value) || 0;

      if(parsedMonthlyPay && parsedTotalRemittance) {
          const total = parsedMonthlyPay - parsedTotalRemittance;

          taxableIncome.value = total.toFixed(2);
      }

      calculateExcess();
  }

  //calculate excess

  function calculateExcess() {
    const parsedTaxableIncome = parseFloat(taxableIncome.value) || 0;
    const parsedCL = parseFloat(taxCl.value) || 0;

    if (parsedTaxableIncome) {
        const total = parsedTaxableIncome - parsedCL;

        taxExcess.value = total.toFixed(2);
     }
     calculateTaxRate();

  }

  //calculate tax rate
  function calculateTaxRate () {
    const parsedTaxPercentage = parseFloat(taxRatePercentage.value) || 0;
    const parsedTaxExcess = parseFloat(taxExcess.value) || 0;


    const total = (parsedTaxPercentage / 100) * parsedTaxExcess;
    taxRate.value = total.toFixed(2);

    calculateTaxMonth();
    calculateTotalDeductions();
  }

  function calculateTaxMonth() {
    const parsedFixrate = parseFloat(fixedRate.value) || 0;
    const parsedTaxRate = parseFloat(taxRate.value) || 0;

    const total = parsedFixrate + parsedTaxRate;
    taxMonth.value = total.toFixed(2);

    calculateTaxCutOff();
  }

  //calculate tax cut off
  function calculateTaxCutOff() {
    const parsedTaxMonth = parseFloat(taxMonth.value) || 0;


        const total = parsedTaxMonth / 2;

        taxCutoff.value = total.toFixed(2);
        tax.value = total.toFixed(2); //tax value will shows up if the values of tax rate, tax month and tax cut off has filled up.

    calculateTotalDeductions();
  }

  //calculate total deduction
  function calculateTotalDeductions () {
    const parsedEmployeePurchase = parseFloat(employeePurchase.value) || 0;
    const parsedSssLoan = parseFloat(sssLoan.value) || 0;
    const parsedHdmfLoan = parseFloat(hdmfLoan.value) || 0;

    const parsedEmployeeSssPremContribution = parseFloat(employeeSssPremContribution.value) || 0;
    const parsedEmployeeSssWisp = parseFloat(employeeSssWisp.value) || 0;
    const parsedEmployeePhic = parseFloat(employeePhic.value) || 0;
    const parsedEmployeeHdmf = parseFloat(employeeHdmf.value) || 0;
    const parsedMissing_charges = parseFloat(missing_charges.value) || 0;


    const parsedTax = parseFloat(tax.value) || 0;


    //compute net pay
    const parsedGrossPay = parseFloat(grossPay.value) || 0;

    let netPayTotal;



        const totalDeductions = parsedEmployeePurchase + parsedSssLoan + parsedHdmfLoan + parsedEmployeeSssPremContribution + parsedEmployeeSssWisp + parsedEmployeePhic + parsedEmployeeHdmf + parsedMissing_charges + parsedTax;
        totalDeduction.value = totalDeductions.toFixed(2);

        netPayTotal = parsedGrossPay - totalDeductions;
        console.log('gross pay', parsedGrossPay);

        if(parsedGrossPay <= 0) {
            netPay.value = '0.00';
        }
        if(netPayTotal <= 0) {
            netPay.value = '0.00';
        }
        netPay.value = netPayTotal.toFixed(2);

  }

  employeeSssPremContribution.addEventListener('input', showSSSpremContribution);
  employeeSssWisp.addEventListener('input', showSSSWISP);
  employeePhic.addEventListener('input', showPhicContribution);
  employeeHdmf.addEventListener('input', showHdmfContribution);
  taxCl.addEventListener('input', calculateExcess);
  taxRatePercentage.addEventListener('input', calculateTaxRate);
  fixedRate.addEventListener('input', calculateTaxMonth);
  employeePurchase.addEventListener('input', calculateTotalDeductions);
  sssLoan.addEventListener('input', calculateTotalDeductions);
  hdmfLoan.addEventListener('input', calculateTotalDeductions);

</script>

  @endsection
@endsection
