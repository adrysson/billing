<?php

namespace App\Domain\Factories;

use App\Domain\Entities\Debt;
use App\Domain\ValueObjects\DebtAmount;
use App\Domain\ValueObjects\DebtDueDate;
use App\Domain\ValueObjects\DebtId;
use App\Domain\ValueObjects\DebtStatus;

class DebtFactory
{
    public static function createFromArray(array $data): Debt
    {
        $debtAmount = new DebtAmount($data[3]);
        $debtDueDate = new DebtDueDate($data[4]);
        $debtId = new DebtId($data[5]);

        $debtor = DebtorFactory::createFromArray($data);

        return new Debt(
            id: $debtId,
            amount: $debtAmount,
            dueDate: $debtDueDate,
            debtor: $debtor,
            status: DebtStatus::initial(),
        );
    }

    public static function createFromStore(array $data): Debt
    {
        $debtAmount = new DebtAmount($data['amount']);
        $debtDueDate = new DebtDueDate($data['due_date']);
        $debtId = new DebtId($data['uuid']);

        $debtor = DebtorFactory::createFromStore($data);

        return new Debt(
            id: $debtId,
            amount: $debtAmount,
            dueDate: $debtDueDate,
            debtor: $debtor,
            status: new DebtStatus($data['status']),
        );
    }
}
