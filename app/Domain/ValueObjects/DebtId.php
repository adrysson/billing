<?php

namespace App\Domain\ValueObjects;

class DebtId
{
    public function __construct(public readonly int $value)
    {
    }
}
