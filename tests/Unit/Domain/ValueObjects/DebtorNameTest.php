<?php

namespace Tests\Unit;

use App\Domain\ValueObjects\DebtorName;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DebtorNameTest extends TestCase
{
    public function test_should_throw_exception_when_insert_invalid_value(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new DebtorName('');
    }

    public function test_should_create_with_correct_value_when_insert_valid_value(): void
    {
        $name = new DebtorName('John Doe');

        $this->assertEquals('John Doe', $name->value);
    }
}
