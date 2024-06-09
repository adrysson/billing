<?php

namespace App\Domain\ValueObjects;

use DateTime;
use InvalidArgumentException;

class CreatedAt
{
    public function __construct(public readonly string $value)
    {
        $dateTime = date_create_from_format('Y-m-d H:i:s', $value);

        if (!$dateTime || $dateTime->format('Y-m-d H:i:s') !== $value) {
            throw new InvalidArgumentException('Invalid date: ' . $value);
        }
    }

    public static function new(): self
    {
        $createdAt = (new DateTime())->format('Y-m-d H:i:s');

        return new self($createdAt);
    }
}
