<?php

namespace Tests\Unit\Domain\Entities;

use App\Domain\Entities\Debtor;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\ValueObjects\DebtorNameStub;
use Tests\Stubs\Domain\ValueObjects\EmailStub;
use Tests\Stubs\Domain\ValueObjects\GovernmentIdStub;

class DebtorTest extends TestCase
{
    public function test_should_create_with_correct_value_when_insert_valid_value(): void
    {
        $name = DebtorNameStub::random();
        $email = EmailStub::random();
        $governmentId = GovernmentIdStub::random();

        $debtor = new Debtor(
            name: $name,
            email: $email,
            governmentId: $governmentId,
        );

        $this->assertEquals($name, $debtor->name);
        $this->assertEquals($email, $debtor->email);
        $this->assertEquals($governmentId, $debtor->governmentId);
        $this->assertEquals([
            'name' => $name->value,
            'email' => $email->value,
            'government_id' => $governmentId->value,
        ], $debtor->jsonSerialize());
    }
}
