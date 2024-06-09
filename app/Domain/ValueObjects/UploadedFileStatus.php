<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

class UploadedFileStatus
{
    public const ALL = [
        self::RECEIVED,
        self::CREATED,
        self::PROCESSED,
    ];

    public const RECEIVED = 1;

    public const CREATED = 2;

    public const PROCESSED = 3;

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

    public static function final(): self
    {
        return new self(self::PROCESSED);
    }
}
