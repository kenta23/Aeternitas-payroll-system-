<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class PayslipMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $employee;
    public $pdf;


    public function __construct($employee, $pdf)
    {
        //
        $this->employee = $employee;
        $this->pdf = $pdf;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Payslip is here',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payslip',
            with: ([
                'employee' => $this->employee
            ])
        );
    }

    public function build () {
        $todayDate = Carbon::now()->format('d-m-Y');

        return $this->view('emails.payslip2')
                    ->subject('Your Payslip is here')
                    ->with('employee', $this->employee)
                    ->attachData($this->pdf, 'Payslip-' . $this->employee->last_name . '-' . $todayDate . '.pdf', ['mime' => 'application/pdf', ]);  //passing employee to get the employee data
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {

        return [
          /*  Attachment::fromData(fn () => $this->pdf, 'Payslip-' . $this->employee->last_name . '-' . $todayDate . '.pdf')->withMime('application/pdf') */
        ];
    }
}
