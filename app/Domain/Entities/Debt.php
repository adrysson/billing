<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\DebtAmount;
use App\Domain\ValueObjects\DebtDueDate;
use App\Domain\ValueObjects\DebtId;

class Debt
{
    public function __construct(
        public readonly DebtId $id,
        public readonly DebtAmount $amount,
        public readonly DebtDueDate $dueDate,
        public readonly Debtor $debtor,
    ) {
    }
}
