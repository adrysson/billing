<?php

namespace App\Domain\Factories;

use App\Domain\Entities\Debt;
use App\Domain\ValueObjects\DebtAmount;
use App\Domain\ValueObjects\DebtDueDate;
use App\Domain\ValueObjects\DebtId;
use App\Domain\ValueObjects\TransactionId;
use App\Domain\ValueObjects\DebtStatus;

class DebtFactory
{
    public static function new(array $data): Debt
    {
        $debtAmount = new DebtAmount($data[3]);
        $debtDueDate = new DebtDueDate($data[4]);
        $transactionId = new TransactionId($data[5]);

        $debtor = DebtorFactory::new($data);

        return new Debt(
            id: null,
            transactionId: $transactionId,
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
        $transactionId = new TransactionId($data['transaction_id']);

        $debtor = DebtorFactory::createFromStore($data);

        return new Debt(
            id: new DebtId($data['id']),
            transactionId: $transactionId,
            amount: $debtAmount,
            dueDate: $debtDueDate,
            debtor: $debtor,
            status: new DebtStatus($data['status']),
        );
    }
}
