<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

class GovernmentId
{
    public function __construct(public readonly string $value)
    {
        if (strlen($value) != 11 || !ctype_digit($value)) {
            throw new InvalidArgumentException("Invalid Government ID");
        }
    }
}
