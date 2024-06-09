<?php

namespace App\Application;

use App\Domain\Entities\UploadedFile;
use App\Domain\ValueObjects\UploadedFileRealPath;
use Generator;

class BillingProcessingService
{
    private const BATCH_SIZE = 1000;

    public function __construct(
        private readonly DebtBatchService $debtBatchService,
        private readonly UploadedFileStoreService $uploadedFileStoreService,
        private readonly UploadedFileUpdateService $uploadedFileUpdateService,
    ) {
    }

    public function processBilling(UploadedFile $uploadedFile): void
    {
        $this->uploadedFileStoreService->store($uploadedFile);

        $batchs = $this->getBatches($uploadedFile->realPath);

        $this->debtBatchService->processBatch($batchs);

        $uploadedFile->fileProcessed();

        $this->uploadedFileUpdateService->update($uploadedFile);
    }

    private function getBatches(UploadedFileRealPath $realPath): Generator
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