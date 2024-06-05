<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\DebtorName;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\GovernmentId;

class Debtor
{
    public function __construct(
        public readonly DebtorName $name,
        public readonly Email $email,
        public readonly GovernmentId $governmentId,
    ) {
    }
}
