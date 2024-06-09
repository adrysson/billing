<?php

namespace Tests\Unit\Domain\Entities;

use App\Domain\Entities\UploadedFile;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\ValueObjects\CreatedAtStub;
use Tests\Stubs\Domain\ValueObjects\UploadedFileIdStub;
use Tests\Stubs\Domain\ValueObjects\UploadedFileNameStub;
use Tests\Stubs\Domain\ValueObjects\UploadedFileRealPathStub;
use Tests\Stubs\Domain\ValueObjects\UploadedFileStatusStub;

class UploadedFileTest extends TestCase
{
    public function test_should_create_with_correct_value_when_insert_valid_value(): void
    {
        $id = UploadedFileIdStub::random();
        $name = UploadedFileNameStub::random();
        $realPath = UploadedFileRealPathStub::random();
        $status = UploadedFileStatusStub::random();
        $createdAt = CreatedAtStub::random();

        $uploadedFile = new UploadedFile(
            id: $id,
            name: $name,
            realPath: $realPath,
            status: $status,
            createdAt: $createdAt,
        );

        $this->assertEquals($id, $uploadedFile->id());
        $this->assertEquals($name, $uploadedFile->name);
        $this->assertEquals($realPath, $uploadedFile->realPath);
        $this->assertEquals($status, $uploadedFile->status());
        $this->assertEquals($createdAt, $uploadedFile->createdAt);
        $this->assertEquals([
            'id' => $id->value,
            'name' => $name->value,
            'real_path' => $realPath->value,
            'status' => $status->value,
            'created_at' => $createdAt->value,
        ], $uploadedFile->jsonSerialize());
    }
}
