<?php

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\UploadedFileStatus;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\ValueObjects\UploadedFileStatusStub;

class UploadedFileStatusTest extends TestCase
{
    public function test_should_throw_exception_when_insert_invalid_value(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new UploadedFileStatus(1234);
    }

    public function test_should_create_with_correct_value_when_insert_valid_value(): void
    {
        $stub = UploadedFileStatusStub::random();

        $status = new UploadedFileStatus($stub->value);

        $this->assertEquals($stub->value, $status->value);
    }
}
