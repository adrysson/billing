<?php

namespace Tests\Unit\Domain\Factories;

use App\Domain\Entities\Debtor;
use App\Domain\Factories\DebtorFactory;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entities\DebtorStub;

class DebtorFactoryTest extends TestCase
{
    public function test_should_create_from_array_method_create_entity(): void
    {
        $stub = DebtorStub::random();
        
        $debtor = DebtorFactory::createFromArray([
            $stub->name->value,
            $stub->governmentId->value,
            $stub->email->value,
        ]);

        $this->assertInstanceOf(Debtor::class, $debtor);
        $this->assertEquals($stub->name->value, $debtor->name->value);
        $this->assertEquals($stub->governmentId->value, $debtor->governmentId->value);
        $this->assertEquals($stub->email->value, $debtor->email->value);
    }
}
