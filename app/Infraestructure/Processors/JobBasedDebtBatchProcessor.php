<?php

namespace App\Infraestructure\Processors;

use App\Domain\Contracts\DebtBatchesProcessor;
use App\Infraestructure\Jobs\SendEmailJob;
use Generator;

class JobBasedDebtBatchProcessor implements DebtBatchesProcessor
{
    public function processBatch(Generator $batches): void
    {
        foreach ($batches as $batch) {
            SendEmailJob::dispatch($batch);
        }
    }
}