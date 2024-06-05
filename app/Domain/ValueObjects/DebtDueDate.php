<?php

namespace App\Domain\ValueObjects;

use DateTime;
use InvalidArgumentException;

class DebtDueDate
{
    public function __construct(public readonly float $value)
    {
        $date = DateTime::createFromFormat('Y-m-d', $value);
        if (!$date || $date->format('Y-m-d') !== $value) {
            throw new InvalidArgumentException("Invalid date format");
        }
    }
}