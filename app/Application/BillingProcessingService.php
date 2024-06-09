<?php

namespace App\Application;

use App\Domain\Contracts\DebtBatchesProcessor;
use App\Domain\Entities\UploadedFile;
use App\Domain\Repositories\UploadedFileRepository;
use App\Domain\ValueObjects\UploadedFileRealPath;
use Generator;

class BillingProcessingService
{
    private const BATCH_SIZE = 1000;

    public function __construct(
        private readonly DebtBatchesProcessor $debtBatchesProcessor,
        private readonly UploadedFileRepository $uploadedFileRepository,
    ) {
    }

    public function processBilling(UploadedFile $uploadedFile): void
    {
        $this->uploadedFileRepository->store($uploadedFile);

        $batches = $this->getBatches($uploadedFile->realPath);

        $this->debtBatchesProcessor->processBatch($batches);

        $uploadedFile->fileProcessed();

        $this->uploadedFileRepository->update($uploadedFile);
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