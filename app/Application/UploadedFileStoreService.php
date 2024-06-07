<?php

namespace App\Application;

use App\Domain\Contracts\DebtBatchesProcessor;
use App\Domain\Entities\UploadedFile;
use App\Domain\Repositories\UploadedFileRepository;
use Generator;

class UploadedFileStoreService
{
    public function __construct(
        private readonly UploadedFileRepository $uploadedFileRepository,
    ) {
    }

    public function store(UploadedFile $uploadedFile): void
    {
        $this->uploadedFileRepository->store($uploadedFile);
    }
}