<?php

namespace App\Infraestructure\FileReaders;

use App\Domain\Contracts\BillingFileReader;
use App\Domain\ValueObjects\UploadedFileRealPath;
use Generator;

class CsvFileReader implements BillingFileReader
{
    private const BATCH_SIZE = 1000;

    public function getBatches(UploadedFileRealPath $realPath): Generator
    {
        if (($handle = fopen($realPath->value, 'r')) !== false) {
            fgetcsv($handle);
            $batch = [];
            while (($row = fgets($handle)) !== false) {
                $batch[] = $row;
    
                if (count($batch) >= self::BATCH_SIZE) {
                    yield $batch;
                    $batch = [];
                }
            }

            if (!empty($batch)) {
                yield $batch;
            }

            fclose($handle);
        }
    }
}