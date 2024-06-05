<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

class DebtId
{
    public function __construct(public readonly float $value)
    {
        if (!Uuid::isValid($value)) {
            throw new InvalidArgumentException("Invalid UUID format");
        }
    }
}
