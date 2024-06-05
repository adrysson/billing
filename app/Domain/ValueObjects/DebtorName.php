<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

class DebtorName
{
    public function __construct(public readonly string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException("Debtor name cannot be empty");
        }
    }
}
