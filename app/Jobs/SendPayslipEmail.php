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
use Mailgun\Mailgun;


class SendPayslipEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

     protected $pdf;
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

       /* $todayDate = Carbon::now()->format('d-m-Y');

        // Generate PDF
        $pdf = PDF::loadView('payroll.pdfpayslip', compact('employee'));
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdfContent = $pdf->output(); */

        // Send Email

        try {
            Mail::mailer('mailgun')
                ->to($this->employee->email)
                ->send(new PayslipMail($this->employee, $this->pdf));

            // Log success or perform further actions
        } catch (\Exception $e) {
            // Log the error
            \Log::error("Failed to send payslip to {$this->employee->email}: " . $e->getMessage());
        }
    }
}
