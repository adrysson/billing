<?php

namespace Tests\Unit\Domain\Entities;

use App\Domain\Entities\UploadedFile;
use App\Domain\Factories\UploadedFileFactory;
use App\Domain\ValueObjects\UploadedFileStatus;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entities\UploadedFileStub;
use Tests\Stubs\Domain\ValueObjects\UploadedFileIdStub;
use Tests\Stubs\Domain\ValueObjects\UploadedFileNameStub;
use Tests\Stubs\Domain\ValueObjects\UploadedFileRealPathStub;

class UploadedFileTest extends TestCase
{
    public function test_should_create_with_correct_value_when_insert_valid_value(): void
    {
        $stub = UploadedFileStub::random();

        $uploadedFile = new UploadedFile(
            id: $stub->id(),
            name: $stub->name,
            realPath: $stub->realPath,
            status: $stub->status(),
            createdAt: $stub->createdAt,
        );

        $this->assertEquals($stub->id(), $uploadedFile->id());
        $this->assertEquals($stub->name, $uploadedFile->name);
        $this->assertEquals($stub->realPath, $uploadedFile->realPath);
        $this->assertEquals($stub->status(), $uploadedFile->status());
        $this->assertEquals($stub->createdAt, $uploadedFile->createdAt);
        $this->assertEquals([
            'id' => $stub->id()->value,
            'name' => $stub->name->value,
            'real_path' => $stub->realPath->value,
            'status' => $stub->status()->value,
            'created_at' => $stub->createdAt->value,
        ], $uploadedFile->jsonSerialize());
    }

    public function test_should_created_add_id_to_entity(): void
    {
        $name = UploadedFileNameStub::random();
        $realPath = UploadedFileRealPathStub::random();

        $uploadedFile = UploadedFileFactory::new(
            fileName: $name->value,
            realPath: $realPath->value,
        );

        $this->assertNull($uploadedFile->id());

        $id = UploadedFileIdStub::random();

        $uploadedFile->created($id);

        $this->assertEquals($id->value, $uploadedFile->id()->value);
    }

    public function test_should_processed_change_status_to_processed(): void
    {
        $uploadedFile = UploadedFileStub::created();

        $uploadedFile->processed();

        $this->assertEquals(UploadedFileStatus::processed()->value, $uploadedFile->status()->value);
    }
}
