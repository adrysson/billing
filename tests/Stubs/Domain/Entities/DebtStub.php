<?php

namespace Tests\Stubs\Domain\Entities;

use App\Domain\Entities\Debt;
use Tests\Stubs\Domain\ValueObjects\DebtAmountStub;
use Tests\Stubs\Domain\ValueObjects\DebtDueDateStub;
use Tests\Stubs\Domain\ValueObjects\DebtIdStub;
use Tests\Stubs\Domain\ValueObjects\TransactionIdStub;
use Tests\Stubs\Domain\ValueObjects\DebtStatusStub;

class DebtStub
{
    public static function random(): Debt
    {
        return new Debt(
            id: DebtIdStub::random(),
            transactionId: TransactionIdStub::random(),
            amount: DebtAmountStub::random(),
            dueDate: DebtDueDateStub::random(),
            debtor: DebtorStub::random(),
            status: DebtStatusStub::random(),
        );
    }
}
