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

<!-- TAB CONTENT -->
<div class="tab-content">
    <div class="p-3 border tab-pane fade show active" id="sss-pane" role="tabpanel" aria-labelledby="sss_tab">
        <h2 class="text-success">SSS - PHILHEALTH - PAG-IBIG - LOANS</h2> <hr>

        <div class="row mb-6">
            <div class="col-md-6">
                <label> <b> Loan</b></label> <br>
                <label> Employee Purchase</label>
                <input type="number" id="#" name="#" value="{{ $employee->employee_purchase }}" class="form-control" readonly>
                <label> CASH advance </label>
                <input type="number" id="#" name="#" value="{{ $employee->cash_advance }}"  class="form-control" readonly>
                <label> Uniforms </label>
                <input type="number" id="#" name="#" value="{{ $employee->uniform }}" class="form-control" readonly>

                <hr>

                <label> SSS Loan (₱)</label>
                <input type="number" id="#" name="#" value="{{ $employee->sss_loan }}" class="form-control" readonly>

                <label> Pag-Ibig Loan (₱)</label>
                <input type="number" id="#" name="#" value="{{ $employee->hdmf_loan }}" class="form-control" readonly>

                <hr>

                <label> Other Deduction (₱)</label>
                <input type="number" id="otherdeduction" name="otherdeduction" value="{{ $employee->otherdeduction }}" class="form-control" step="0.01" >


            </div>

            <div class="col-md-6">
                <label> <b> SSS - Prem. Contribution</b></label> <br>

                <label> EMPLOYEE</label>
                <input type="number" id="show_sss_premcontribution" name="show_sss_premcontribution" value="#" class="form-control" readonly>
                <label> EMPLOYEER</label>
                <input type="number" id="employer_sss_premcontribution" step="0.01" name="employer_sss_premcontribution" value="{{ $employee->employer_sss_premcontribution }}" class="form-control" >

                <hr>

                <label> <b> SSS - WISP</b></label> <br>

                <label> EMPLOYEE</label>
                <input type="number" id="show_sss_wisp" name="show_sss_wisp" value="#" class="form-control" readonly>
                <label> EMPLOYEER</label>
                <input type="number" id="employer_sss_wisp" step="0.01" name="employer_sss_wisp" value="{{ $employee->employer_sss_wisp }}" class="form-control" >

                <hr>

                <label> <b> PHILHEALTH</b></label> <br>

                <label> EMPLOYEE</label>
                <input type="number" id="show_phic" name="show_phic" value="#" class="form-control" readonly>
                <label> EMPLOYEER</label>
                <input type="number" id="employer_phic" step="0.01" name="employer_phic" value="{{ $employee->employer_phic }}" class="form-control" >

                <hr>

                <label> <b> HDMF</b></label> <br>

                <label> EMPLOYEE</label>
                <input type="number" id="show_hdmf" name="show_hdmf" value="#" class="form-control" readonly>
                <label> EMPLOYEER</label>
                <input type="number" id="employer_hdmf" step="0.01" name="employer_hdmf" value="{{ $employee->employer_hdmf }}" class="form-control" >

                <hr>

                <label> TAX (₱)</label>
                <input type="number" id="show_tax2" name="#" value="#" class="form-control" readonly>

                <hr>

                <label> Total Deductions (₱)</label>
                <input type="number" id="total_deduction" name="total_deduction" step="0.01" value="#" class="form-control" readonly>
            </div>

        </div>
    </div>

    <div class="p-3 border tab-pane fade" id="taxes-pane" role="tabpanel" aria-labelledby="taxes-tab">
        <h2 class="text-success">Taxes</h2> <hr>

        <div class="row">
            <div class="col-md-6">
                <label>BASIC SALARY</label>
                <input type="number" id="show_basic_pay" name="show_basic_pay" value="#" class="form-control" readonly>
                <label>SSS Prem. Contribution</label>
                <input type="number" id="tax_sss_premcontribution" name="tax_sss_premcontribution" value="{{ $employee->tax_sss_premcontribution }}" class="form-control" readonly>
                <label>SSS WISP</label>
                <input type="number" id="tax_sss_wisp" name="tax_sss_wisp" value="{{ $employee->tax_sss_wisp }}" class="form-control" readonly>
                <label>PHIC Contribution</label>
                <input type="number" id="tax_phic" name="tax_phic" value="{{ $employee->tax_phic }}" class="form-control" readonly>
                <label>PAG-IBIG Contribution</label>
                <input type="number" id="tax_hdmf" name="tax_hdmf" value="{{ $employee->tax_hdmf }}" class="form-control" readonly>
                <label>Total Remittance</label>
                <input type="number" id="totalremittance" name="totalremittance" value="{{ $employee->totalremittance }}" class="form-control" readonly>
                <label>Taxable Income</label>
                <input type="number" id="taxable_income" name="taxable_income" value="{{ $employee->taxable_income }}" class="form-control" readonly>
            </div>

            <div class="col-md-6">
                <label>CL</label>
                <input type="number" id="tax_cl" name="tax_cl" value="{{ $employee->tax_cl }}" class="form-control" >
                <label>Excess <i class="text text-danger">Please update first to calculate!</i></label>
                <input type="number" id="tax_excess" name="tax_excess" value="{{ $employee->tax_excess }}" class="form-control" readonly>
                <label>Tax Rate (Decimal Ex. 15% = 0.15)</label>
                <input type="number" id="tax_rate_percentage" name="tax_rate_percentage" step="0.01" value="{{ $employee->tax_rate_percentage }}" class="form-control" >
                <input type="number" id="tax_rate" name="tax_rate" step="0.01" value="{{ $employee->tax_rate }}" class="form-control" readonly>
                <label>Fixed Rate</label>
                <input type="number" id="fixed_rate" name="fixed_rate" step="0.01" value="{{ $employee->fixed_rate }}" class="form-control" >
                <label>WHTax/month</label>
                <input type="number" id="tax_month" name="tax_month" step="0.01" value="{{ $employee->tax_month }} " class="form-control" readonly>
                <label>WHTax/cut-off</label>
                <input type="number" id="tax_cutoff" name="tax_cutoff" step="0.01" value="{{ $employee->tax_cutoff }}" class="form-control" readonly>

            </div>
        </div>
    </div>
  </div>

  <div class="submit-section">
    <button type="submit" class="btn btn-primary submit-btn">Update</button>
  </div>

    </div>
  </div>
@endsection
