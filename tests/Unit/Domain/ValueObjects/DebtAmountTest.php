<?php

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\DebtAmount;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DebtAmountTest extends TestCase
{
    public function test_should_throw_exception_when_insert_invalid_value(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new DebtAmount(-1);
    }

    public function test_should_create_with_correct_value_when_insert_valid_value(): void
    {
        $amount = new DebtAmount(10000.00);

        $this->assertEquals(10000.00, $amount->value);
    }
}
