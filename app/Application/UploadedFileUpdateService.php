<?php

namespace App\Application;

use App\Domain\Entities\UploadedFile;
use App\Domain\Repositories\UploadedFileRepository;

class UploadedFileUpdateService
{
    public function __construct(
        private readonly UploadedFileRepository $uploadedFileRepository,
    ) {
    }

    public function update(UploadedFile $uploadedFile): void
    {
        $this->uploadedFileRepository->update($uploadedFile);
    }
}