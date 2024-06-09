<?php

namespace Tests\Unit\Domain\Factories;

use App\Domain\Factories\UploadedFileFactory;
use App\Domain\ValueObjects\CreatedAt;
use App\Domain\ValueObjects\UploadedFileName;
use App\Domain\ValueObjects\UploadedFileStatus;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\ValueObjects\UploadedFileNameStub;
use Tests\Stubs\Domain\ValueObjects\UploadedFileRealPathStub;

class UploadedFileFactoryTest extends TestCase
{
    public function test_should_new_method_create_entity_without_id(): void
    {
        $fileName = UploadedFileNameStub::random();
        $realPath = UploadedFileRealPathStub::random();

        $uploadedFile = UploadedFileFactory::new(
            fileName: $fileName->value,
            realPath: $realPath->value,
        );

        $this->assertNull($uploadedFile->id());
        $this->assertEquals($fileName->value, $uploadedFile->name->value);
        $this->assertEquals($realPath->value, $uploadedFile->realPath->value);
        $this->assertEquals(UploadedFileStatus::initial()->value, $uploadedFile->status()->value);
        $this->assertInstanceOf(CreatedAt::class, $uploadedFile->createdAt);
    }
}
