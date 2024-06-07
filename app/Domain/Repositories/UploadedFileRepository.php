<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\UploadedFile;

interface UploadedFileRepository
{
    public function store(UploadedFile $uploadedFile): void;
}
