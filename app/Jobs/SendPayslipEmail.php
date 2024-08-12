<?php

namespace App\Jobs;

use App\Mail\PayslipMail;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPayslipEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

     public $pdf;
     protected  $employee;


    public function __construct($pdf, $employee)
    {
        //
        $this->pdf = $pdf;
        $this->employee = $employee;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       /* $employees = Employee::all();
        //
       foreach($employees as $emp) {
          Mail::to($emp->email)->send(new PayslipMail($emp, $this->pdf));
       } */

        $todayDate = Carbon::now()->format('d-m-Y');

        // Generate PDF
        $pdf = PDF::loadView('payroll.pdfpayslip', compact('employee'));
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdfContent = $pdf->output();

        // Send Email
        Mail::to($this->employee->email)->send(new PayslipMail($this->employee, $pdfContent));
    }
}
