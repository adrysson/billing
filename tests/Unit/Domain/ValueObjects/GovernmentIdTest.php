<?php

namespace Tests\Unit;

use App\Domain\ValueObjects\GovernmentId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class GovernmentIdTest extends TestCase
{
    public function test_should_throw_exception_when_insert_invalid_value(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new GovernmentId('11111111111');
    }

    public function test_should_create_with_correct_value_when_insert_valid_value(): void
    {
        $governmentId = new GovernmentId('8226');

        $this->assertEquals('8226', $governmentId->value);
    }
}
