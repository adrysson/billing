<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

class Email
{
    public function __construct(public readonly string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format: " . $value);
        }
    }
}