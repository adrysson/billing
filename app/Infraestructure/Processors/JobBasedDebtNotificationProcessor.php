<?php

namespace App\Infraestructure\Processors;

use App\Domain\Contracts\DebtNotificationProcessor;
use App\Domain\Entities\Debt;
use App\Infraestructure\Jobs\ProcessDebtNotificationJob;
use Generator;

class JobBasedDebtNotificationProcessor implements DebtNotificationProcessor
{
    public function processNotificationDebt(Debt $debt): void
    {
        ProcessDebtNotificationJob::dispatch($debt)->onQueue('debt-notification-processing');
    }
}