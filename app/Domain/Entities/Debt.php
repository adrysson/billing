<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\DebtAmount;
use App\Domain\ValueObjects\DebtDueDate;
use App\Domain\ValueObjects\DebtId;
use App\Domain\ValueObjects\TransactionId;
use App\Domain\ValueObjects\DebtStatus;
use JsonSerializable;

class Debt implements JsonSerializable
{
    public function __construct(
        private ?DebtId $id,
        public readonly TransactionId $transactionId,
        public readonly DebtAmount $amount,
        public readonly DebtDueDate $dueDate,
        public readonly Debtor $debtor,
        private DebtStatus $status,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id()->value,
            'transaction_id' => $this->transactionId->value,
            'amount' => $this->amount->value,
            'due_date' => $this->dueDate->value,
            'debtor' => $this->debtor->jsonSerialize(),
            'status' => $this->status->value,
        ];
    }

    public function id(): ?DebtId
    {
        return $this->id;
    }

    public function status(): DebtStatus
    {
        return $this->status;
    }

    public function created(DebtId $id): void
    {
        $this->id = $this->id;
    }

    public function charged(): void
    {
        $this->status = DebtStatus::charged();
    }

    public function expired(): void
    {
        $this->status = DebtStatus::expired();
    }
}
