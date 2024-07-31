
@extends('layouts.exportmaster')

@section('styles')
   <style>
        .broken-underline {
        text-decoration: underline;
        text-decoration-style: dashed; /* or dotted */
    }

    @media print {
        .no-print {
            display: none !important;
        }
    }
   .basic-pay-and-deductions {
     display: flex;
     align-items: center;
     gap: 0 25px;
   }
   .amount {
     text-decoration: underline;
   }
   .payslip-info {
       border: 0.5px dashed gray;
   }

   </style>
@endsection



@section('content')
    <!-- Page Wrapper -->
    <div class="">
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content" id="app">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Eternal Bright Sanctuary Inc.</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Payslip</li>
                        </ul>
                    </div>

                    <div class="col-auto float-right ml-auto no-print">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-white" style="color: green"><i class="fa fa-file-excel-o"></i><a href="/sample"> Excel</a></button>
                            <button class="btn btn-white" style="color: red"><i class="fa fa-file-pdf-o"></i> <a href="hjgj">PDF</a></button>
                            <a href="" target="_blank" @click.prevent="printme">
                                <button class="btn btn-white" style="color: black"><i class="fa fa-print fa-lg"></i> Print</button>
                            </a>
                        </div>
                    </div>
                </div>

            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="payslip-title">Payslip for the month of {{ \Carbon\Carbon::now()->format('M') }}   {{ \Carbon\Carbon::now()->year }}  </h4>
                            <div class="row">
                                <div class="col-sm-6 m-b-20">
                                    <ul class="list-unstyled mb-2">
                                        <li>Name: </li>
                                        <li>Position:</li>
                                        <li>Department:</li>
                                        <li>Basic Compensation:</li>
                                    </ul>
                                </div>


                                <div class="col-sm-6 m-b-20">
                                    <div class="invoice-details">
                                        <h3 class="text-uppercase">Payslip #49029</h3>
                                        <ul class="list-unstyled">
                                            <li>Salary Month: <span>{{ \Carbon\Carbon::now()->format('M') }}  , {{ \Carbon\Carbon::now()->year }}  </span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class='dashed' />


                            <div class="row payslip-info px-2 pt-3 pb-1">
                                <div class="col-sm-6">
                                    <h3>Basic Pay</h3>

                                    <h3 class="text-right">Amount</h3>
                                    <div class="d-flex align-items-center gap-4">
                                        <p class="">Days of work: </p>
                                        <p class="">13 Days</p>
                                    </div>
                                    <div class="d-flex align-items-center gap-4">
                                        <p class="">Regular days worked: </p>
                                        <p class="">13 Days</p>
                                    </div>
                                    <div class="d-flex align-items-center gap-4">
                                        <p class="">Legal Holiday: </p>
                                        <p class="">13 Days</p>
                                    </div>

                                    <div class="d-flex align-items-center gap-4">
                                        <p class="">Speial Holiday: </p>
                                        <p class="">13 Days</p>
                                    </div>

                                    <div class="d-flex align-items-center gap-4">
                                        <p class="">Total Basic Pay: </p>
                                        <p class="">13 Days</p>
                                    </div>

                                    <div class="d-flex align-items-center gap-4">
                                        <p class="">Less late (mins): </p>
                                        <p class="">13 Days</p>
                                    </div>

                                    <div class="d-flex align-items-center gap-4">
                                        <p class="">Net basic pay: </p>
                                        <p class="">13 Days</p>
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                        <h3>Deductions</h3>
                                        <h3 class="text-right">Amount</h3>

                                        <div>
                                            <p class="">SSS: </p>
                                            <p class=""></p>
                                        </div>

                                        <div>
                                            <p class="">PHIC: </p>
                                            <p class=""></p>
                                        </div>

                                        <div>
                                            <p class="">HDMF: </p>
                                            <p class=""></p>
                                        </div>

                                        <div>
                                            <p class="">WHTax: </p>
                                            <p class=""></p>
                                        </div>

                                        <div>
                                            <p class="">SSS Loans: </p>
                                            <p class=""></p>
                                        </div>

                                        <div>
                                            <p class="">Company Loans: </p>
                                            <p class=""></p>
                                        </div>

                                        <div>
                                            <p class="">Cash Advances: </p>
                                            <p class=""></p>
                                        </div>

                                        <div>
                                            <p class="">Absences: </p>
                                            <p class=""></p>
                                        </div>

                                        <div>
                                            <p class="">Other Charges: </p>
                                            <p class=""></p>
                                        </div>
                                </div>

                                <div class="col-sm-6">
                                      <h3>Other Pay</h3>

                                      <div>
                                         <p>Reg. OT (hrs): </p>
                                         <p></p>
                                      </div>

                                      <div>
                                        <p>Night Diff. (hrs): </p>
                                        <p></p>
                                     </div>

                                     <div>
                                        <p>Meal Allowance: </p>
                                        <p></p>
                                     </div>

                                     <div>
                                        <p>Transpo Allowance</p>
                                        <p>Incentive Leave</p>
                                     </div>

                                     <div>
                                         <p>Adjustments: </p>
                                         <p></p>
                                     </div>

                                     <div>
                                         <p class="font-weight-bold">Total Other Pay: </p>
                                         <p></p>
                                     </div>
                                </div>


                                <div class="col-sm-6 my-auto">
                                    <div>
                                         <p class="font-weight-bold">Total Deductions: </p>
                                         <p></p>
                                    </div>

                                </div>

                                <div class="col-sm-10">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mt-2">
                                            <p class="font-weight-bold">Gross Pay: </p>
                                            <p></p>
                                        </div>


                                        <div class="mt-2">
                                            <p class="font-weight-bold">Net Pay: </p>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-6 mt-4">
                                    <p>RECEIVED BY:</p>
                                    <p class="text-underline">Employee name</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    </div>

@endsection
