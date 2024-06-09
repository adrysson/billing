<?php

namespace App\Infraestructure\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DebtNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $debt;

    public function __construct($debt)
    {
        $this->debt = $debt;
    }

    public function build()
    {
        return $this->view('emails.debt_notification');
    }
}
