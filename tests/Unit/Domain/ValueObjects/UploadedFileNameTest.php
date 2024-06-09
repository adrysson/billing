<?php

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\UploadedFileId;
use App\Domain\ValueObjects\UploadedFileName;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UploadedFileNameTest extends TestCase
{
    public function test_should_throw_exception_when_insert_invalid_value(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new UploadedFileName('arquivo.jpg');
    }

    public function test_should_create_with_correct_value_when_insert_valid_value(): void
    {
        $name = new UploadedFileName('arquivo.csv');

        $this->assertEquals('arquivo.csv', $name->value);
    }
}
