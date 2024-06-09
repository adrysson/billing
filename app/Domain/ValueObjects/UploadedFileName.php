<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

class UploadedFileName
{
    public function __construct(public readonly string $value)
    {
        $extension = pathinfo($value, PATHINFO_EXTENSION);

        if (strtolower($extension) !== 'csv') {
            throw new InvalidArgumentException('Invalid file format: ' . $extension);
        }
    }
}
