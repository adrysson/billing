<?php

namespace App\Infraestructure\Processors\JobBased;

use App\Domain\Contracts\DebtBatchesProcessor;
use App\Infraestructure\Jobs\ProcessBatchJob;
use Generator;

class JobBasedDebtBatchProcessor implements DebtBatchesProcessor
{
    public function processBatch(Generator $batches): void
    {
        foreach ($batches as $batch) {
            ProcessBatchJob::dispatch($batch)->onQueue('debt-batch-processing');
        }
    }
}
