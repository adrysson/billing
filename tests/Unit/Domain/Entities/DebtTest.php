<?php

namespace Tests\Unit\Domain\Entities;

use App\Domain\Entities\Debt;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entities\DebtorStub;
use Tests\Stubs\Domain\ValueObjects\DebtAmountStub;
use Tests\Stubs\Domain\ValueObjects\DebtDueDateStub;
use Tests\Stubs\Domain\ValueObjects\DebtIdStub;

class DebtTest extends TestCase
{
    public function test_should_create_with_correct_value_when_insert_valid_value(): void
    {
        $debtId = DebtIdStub::random();
        $debtAmount = DebtAmountStub::random();
        $debtDueDate = DebtDueDateStub::random();
        $debtor = DebtorStub::random();

        $debt = new Debt(
            id: $debtId,
            amount: $debtAmount,
            dueDate: $debtDueDate,
            debtor: $debtor,
        );

        $this->assertEquals($debtId, $debt->id);
        $this->assertEquals($debtAmount, $debt->amount);
        $this->assertEquals($debtDueDate, $debt->dueDate);
        $this->assertEquals($debtor, $debt->debtor);
        $this->assertEquals([
            'id' => $debtId->value,
            'amount' => $debtAmount->value,
            'due_date' => $debtDueDate->value,
            'debtor' => $debtor->jsonSerialize(),
        ], $debt->jsonSerialize());
    }
}
