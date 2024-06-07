<?php

namespace App\Domain\Factories;

use App\Domain\Entities\UploadedFile;
use App\Domain\ValueObjects\CreatedAt;
use App\Domain\ValueObjects\UploadedFileName;

class UploadedFileFactory
{
    public static function new(string $fileName): UploadedFile
    {
        $name = new UploadedFileName($fileName);
        $createdAt = CreatedAt::new();

        return new UploadedFile(
            id: null,
            name: $name,
            createdAt: $createdAt,
        );
    }
}
