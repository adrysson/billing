<?php

namespace App\Application;

use App\Domain\Contracts\DebtBatchesProcessor;
use Generator;

class DebtBatchService
{
    public function __construct(
        private readonly DebtBatchesProcessor $debtBatchesProcessor,
    ) {
    }

    public function processBatch(Generator $batches): void
    {
        $this->debtBatchesProcessor->processBatch($batches);
    }
}