<?php

namespace App\Domain\Factories;

use App\Domain\Entities\UploadedFile;
use App\Domain\ValueObjects\CreatedAt;
use App\Domain\ValueObjects\UploadedFileName;
use App\Domain\ValueObjects\UploadedFileRealPath;
use App\Domain\ValueObjects\UploadedFileStatus;

class UploadedFileFactory
{
    public static function new(string $fileName, string $realPath): UploadedFile
    {
        return new UploadedFile(
            id: null,
            name: new UploadedFileName($fileName),
            realPath: new UploadedFileRealPath($realPath),
            status: UploadedFileStatus::initial(),
            createdAt: CreatedAt::new(),
        );
    }
}
