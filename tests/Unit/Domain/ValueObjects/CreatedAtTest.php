<?php

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\CreatedAt;
use App\Domain\ValueObjects\UploadedFileId;
use App\Domain\ValueObjects\UploadedFileName;
use DateTime;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CreatedAtTest extends TestCase
{
    public function test_should_throw_exception_when_insert_invalid_value(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new CreatedAt('12/09/2024');
    }

    public function test_should_create_with_correct_value_when_insert_valid_value(): void
    {
        $date = (new DateTime())->format('Y-m-d H:i:s');
        $createdAt = new CreatedAt($date);

        $this->assertEquals($date, $createdAt->value);
    }
}
