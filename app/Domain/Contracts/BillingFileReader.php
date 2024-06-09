<?php

namespace App\Domain\Contracts;

use App\Domain\ValueObjects\UploadedFileRealPath;
use Generator;

interface BillingFileReader
{
    public function getBatches(UploadedFileRealPath $realPath): Generator;
}