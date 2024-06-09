<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

class DebtStatus
{
    public const ALL = [
        self::RECEIVED,
        self::CREATED,
        self::CHARGED,
        self::PAID,
    ];

    public const RECEIVED = 1;

    public const CREATED = 2;

    public const CHARGED = 3;

    public const EXPIRED = 4;

    public const PAID = 5;

    public function __construct(public readonly int $value)
    {
        if (! in_array($value, self::ALL)) {
            throw new InvalidArgumentException('Invalid status: ' . $value);
        }
    }

    public static function initial(): self
    {
        return new self(self::RECEIVED);
    }

    public static function created(): self
    {
        return new self(self::CREATED);
    }

    public static function charged(): self
    {
        return new self(self::CHARGED);
    }

    public static function expired(): self
    {
        return new self(self::EXPIRED);
    }

    public static function paid(): self
    {
        return new self(self::PAID);
    }

    public static function canCharge(): array
    {
        return [
            self::CREATED,
            self::EXPIRED,
        ];
    }
}
