<?php

namespace App\Application\Commands;

use App\Domain\Contracts\BillingFileReader;
use App\Domain\Contracts\DebtStoreBatchesProcessor;
use App\Domain\Entities\UploadedFile;
use App\Domain\Repositories\UploadedFileRepository;

class BillingProcessingService
{
    public function __construct(
        private readonly DebtStoreBatchesProcessor $debtStoreBatchesProcessor,
        private readonly UploadedFileRepository $uploadedFileRepository,
        private readonly BillingFileReader $billingFileReader,
    ) {
    }

    public function processBilling(UploadedFile $uploadedFile): void
    {
        $this->uploadedFileRepository->store($uploadedFile);

        $batches = $this->billingFileReader->getBatches($uploadedFile->realPath);

        $this->debtStoreBatchesProcessor->processBatch($batches);

        $uploadedFile->processed();

        $this->uploadedFileRepository->update($uploadedFile);
    }
}