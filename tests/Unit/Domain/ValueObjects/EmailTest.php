<?php

namespace Tests\Unit;

use App\Domain\ValueObjects\Email;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function test_should_throw_exception_when_insert_invalid_value(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Email('name');
    }

    public function test_should_create_with_correct_value_when_insert_valid_value(): void
    {
        $email = new Email('johndoe@kanastra.com.br');

        $this->assertEquals('johndoe@kanastra.com.br', $email->value);
    }
}
