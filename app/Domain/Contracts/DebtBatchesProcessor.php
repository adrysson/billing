<?php

namespace App\Domain\Contracts;

use Generator;

interface DebtBatchesProcessor
{
    public function processBatch(Generator $batches): void;
}