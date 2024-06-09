<?php

namespace App\Domain\ValueObjects;

class UploadedFileRealPath
{
    public function __construct(public readonly string $value)
    {
    }
}
