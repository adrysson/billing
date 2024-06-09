<?php

namespace App\Domain\Factories;

use App\Domain\Entities\Debtor;
use App\Domain\ValueObjects\DebtorName;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\GovernmentId;

class DebtorFactory
{
    public static function createFromArray(array $data): Debtor
    {
        $debtorName = new DebtorName($data[0]);
        $governmentId = new GovernmentId($data[1]);
        $email = new Email($data[2]);

        return new Debtor(
            name: $debtorName,
            email: $email,
            governmentId: $governmentId,
        );
    }
}
