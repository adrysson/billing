<?php

namespace App\Infraestructure\Notifiers\Mail;

use App\Domain\Contracts\DebtNotifier;
use App\Domain\Entities\Debt;
use App\Infraestructure\Mail\DebtNotificationMail;
use Illuminate\Support\Facades\Mail;

class MailDebtNotifier implements DebtNotifier
{
    public function notify(Debt $debt)
    {
        Mail::to($debt->debtor->email->value)->send(new DebtNotificationMail($debt));
    }
}