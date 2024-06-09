<?php

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\DebtDueDate;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DebtDueDateTest extends TestCase
{
    public function test_should_throw_exception_when_insert_invalid_value(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new DebtDueDate('12/12/2022');
    }

    public function test_should_create_with_correct_value_when_insert_valid_value(): void
    {
        $date = new DebtDueDate('2022-10-10');

        $this->assertEquals('2022-10-10', $date->value);
    }
}
