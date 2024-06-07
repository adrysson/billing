<?php

namespace App\Domain\ValueObjects;

class UploadedFileId
{
    public function __construct(public readonly int $value)
    {
    }
}
