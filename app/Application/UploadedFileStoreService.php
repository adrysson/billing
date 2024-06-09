<?php

namespace App\Application;

use App\Domain\Entities\UploadedFile;
use App\Domain\Repositories\UploadedFileRepository;

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