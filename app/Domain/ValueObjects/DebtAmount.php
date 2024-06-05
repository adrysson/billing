<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

class DebtAmount
{
    public function __construct(public readonly float $value)
    {
        if ($value <= 0) {
            throw new InvalidArgumentException("Debt amount must be greater than zero");
        }
    }
}