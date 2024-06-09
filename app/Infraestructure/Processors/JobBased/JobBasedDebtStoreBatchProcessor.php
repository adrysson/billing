<?php

namespace App\Infraestructure\Processors\JobBased;

use App\Domain\Contracts\DebtStoreBatchesProcessor;
use App\Infraestructure\Jobs\ProcessDebtStoreBatchJob;
use Generator;

class JobBasedDebtStoreBatchProcessor implements DebtStoreBatchesProcessor
{
    public function processBatch(Generator $batches): void
    {
        foreach ($batches as $batch) {
            ProcessDebtStoreBatchJob::dispatch($batch)->onQueue('debt-batch-processing');
        }
    }
}
