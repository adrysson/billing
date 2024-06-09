<?php

namespace App\Infraestructure\Processors\JobBased;

use App\Domain\Contracts\DebtStoreProcessor;
use App\Domain\Entities\Debt;
use App\Infraestructure\Jobs\ProcessDebtStoreJob;

class JobBasedDebtStoreProcessor implements DebtStoreProcessor
{
    public function processStoreDebt(Debt $debt): void
    {
        ProcessDebtStoreJob::dispatch($debt)->onQueue('debt-store-processing');
    }
}
