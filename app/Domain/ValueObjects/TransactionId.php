<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

class TransactionId
{
    public function __construct(public readonly string $value)
    {
        if (!Uuid::isValid($value)) {
            throw new InvalidArgumentException("Invalid UUID format");
        }
    }
}
