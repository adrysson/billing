<?php

namespace Tests\Unit\Domain\Factories;

use App\Domain\Factories\UploadedFileFactory;
use App\Domain\ValueObjects\CreatedAt;
use PHPUnit\Framework\TestCase;

class UploadedFileFactoryTest extends TestCase
{
    public function test_should_new_method_create_entity_without_id(): void
    {
        $fileName = 'testfile.csv';
        
        $uploadedFile = UploadedFileFactory::new($fileName);

        $this->assertNull($uploadedFile->id);
        $this->assertEquals($fileName, $uploadedFile->name->value);
        $this->assertInstanceOf(CreatedAt::class, $uploadedFile->createdAt);
    }
}
