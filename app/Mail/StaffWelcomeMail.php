<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StaffWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;
    public $tempPassword;
    public $companyName;

    /**
     * Create a new message instance.
     */
    public function __construct($staff, $tempPassword, $companyName)
    {
        $this->staff = $staff;
        $this->tempPassword = $tempPassword;
        $this->companyName = $companyName;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Welcome to ' . $this->companyName . ' - Your Account Details')
                    ->view('emails.staff_welcome')
                    ->with([
                        'staff' => $this->staff,
                        'tempPassword' => $this->tempPassword,
                        'companyName' => $this->companyName,
                    ]);
    }
}
