<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\DebtAmount;
use App\Domain\ValueObjects\DebtDueDate;
use App\Domain\ValueObjects\DebtId;
use App\Domain\ValueObjects\DebtStatus;
use JsonSerializable;

class Debt implements JsonSerializable
{
    public function __construct(
        public readonly DebtId $id,
        public readonly DebtAmount $amount,
        public readonly DebtDueDate $dueDate,
        public readonly Debtor $debtor,
        private DebtStatus $status,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id->value,
            'amount' => $this->amount->value,
            'due_date' => $this->dueDate->value,
            'debtor' => $this->debtor->jsonSerialize(),
            'status' => $this->status->value,
        ];
    }

    public function status(): DebtStatus
    {
        return $this->status;
    }
}
