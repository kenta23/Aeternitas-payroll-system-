<?php

namespace App\Jobs;

use App\Mail\PayslipMail;
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
    protected $employee;

    public function __construct($employee)
    {
        //
        $this->employee = $employee;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        Mail::to($this->employee->email)->send(new PayslipMail($this->employee));
    }
}
