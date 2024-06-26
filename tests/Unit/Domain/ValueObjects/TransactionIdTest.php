<?php

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\TransactionId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TransactionIdTest extends TestCase
{
    public function test_should_throw_exception_when_insert_invalid_value(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new TransactionId(12456);
    }

    public function test_should_create_with_correct_value_when_insert_valid_value(): void
    {
        $id = new TransactionId('f8854797-2592-4e85-8d74-1f4ce432842f');

        $this->assertEquals('f8854797-2592-4e85-8d74-1f4ce432842f', $id->value);
    }
}
