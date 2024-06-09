<?php

namespace Tests\Unit\Domain\Entities;

use App\Domain\Entities\Debt;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entities\DebtorStub;
use Tests\Stubs\Domain\ValueObjects\DebtAmountStub;
use Tests\Stubs\Domain\ValueObjects\DebtDueDateStub;
use Tests\Stubs\Domain\ValueObjects\DebtIdStub;
use Tests\Stubs\Domain\ValueObjects\TransactionIdStub;
use Tests\Stubs\Domain\ValueObjects\DebtStatusStub;

class DebtTest extends TestCase
{
    public function test_should_create_with_correct_value_when_insert_valid_value(): void
    {
        $debtId = DebtIdStub::random();
        $transactionId = TransactionIdStub::random();
        $debtAmount = DebtAmountStub::random();
        $debtDueDate = DebtDueDateStub::random();
        $debtor = DebtorStub::random();
        $status = DebtStatusStub::random();

        $debt = new Debt(
            id: $debtId,
            transactionId: $transactionId,
            amount: $debtAmount,
            dueDate: $debtDueDate,
            debtor: $debtor,
            status: $status,
        );

        $this->assertEquals($transactionId, $debt->transactionId);
        $this->assertEquals($debtAmount, $debt->amount);
        $this->assertEquals($debtDueDate, $debt->dueDate);
        $this->assertEquals($debtor, $debt->debtor);
        $this->assertEquals($status, $debt->status());
        $this->assertEquals([
            'id' => $debtId->value,
            'transaction_id' => $transactionId->value,
            'amount' => $debtAmount->value,
            'due_date' => $debtDueDate->value,
            'debtor' => $debtor->jsonSerialize(),
            'status' => $status->value,
        ], $debt->jsonSerialize());
    }
}
