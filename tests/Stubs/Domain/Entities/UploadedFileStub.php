<?php

namespace Tests\Stubs\Domain\Entities;

use App\Domain\Entities\UploadedFile;
use App\Domain\ValueObjects\UploadedFileStatus;
use Tests\Stubs\Domain\ValueObjects\CreatedAtStub;
use Tests\Stubs\Domain\ValueObjects\UploadedFileIdStub;
use Tests\Stubs\Domain\ValueObjects\UploadedFileNameStub;
use Tests\Stubs\Domain\ValueObjects\UploadedFileRealPathStub;
use Tests\Stubs\Domain\ValueObjects\UploadedFileStatusStub;

class UploadedFileStub
{
    public static function random(): UploadedFile
    {
        $id = UploadedFileIdStub::random();
        $name = UploadedFileNameStub::random();
        $realPath = UploadedFileRealPathStub::random();
        $status = UploadedFileStatusStub::random();
        $createdAt = CreatedAtStub::random();

        return new UploadedFile(
            id: $id,
            name: $name,
            realPath: $realPath,
            status: $status,
            createdAt: $createdAt,
        );
    }

    public static function created(): UploadedFile
    {
        $id = UploadedFileIdStub::random();
        $name = UploadedFileNameStub::random();
        $realPath = UploadedFileRealPathStub::random();
        $status = UploadedFileStatus::created();
        $createdAt = CreatedAtStub::random();

        return new UploadedFile(
            id: $id,
            name: $name,
            realPath: $realPath,
            status: $status,
            createdAt: $createdAt,
        );
    }
}
