<?php

namespace App\Infraestructure\Processors\JobBased;

use App\Domain\Contracts\DebtNotificationProcessor;
use App\Domain\Entities\Debt;
use App\Infraestructure\Jobs\ProcessDebtNotificationJob;

class JobBasedDebtNotificationProcessor implements DebtNotificationProcessor
{
    public function processNotificationDebt(Debt $debt): void
    {
        ProcessDebtNotificationJob::dispatch($debt)->onQueue('debt-notification-processing');
    }
}
