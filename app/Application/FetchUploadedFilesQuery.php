<?php

namespace App\Application;

use App\Domain\Repositories\UploadedFileRepository;

class FetchUploadedFilesQuery
{
    public function __construct(
        private readonly UploadedFileRepository $uploadedFileRepository,
    ) {
    }

    public function execute(
        ?int $id,
        ?string $name,
        ?string $status,
        ?string $createdAt,
        ?int $page
    ): array
    {
        return $this->uploadedFileRepository->findFiltered(
            $id,
            $name,
            $status,
            $createdAt,
            $page
        );
    }
}