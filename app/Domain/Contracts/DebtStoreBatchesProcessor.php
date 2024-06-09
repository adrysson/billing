<?php

namespace App\Domain\Contracts;

use Generator;

interface DebtStoreBatchesProcessor
{
    public function processBatch(Generator $batches): void;
}