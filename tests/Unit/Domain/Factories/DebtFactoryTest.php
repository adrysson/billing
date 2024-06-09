<?php

namespace Tests\Unit\Domain\Factories;

use App\Domain\Entities\Debt;
use App\Domain\Factories\DebtFactory;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entities\DebtStub;

class DebtFactoryTest extends TestCase
{
    public function test_should_create_from_csv_array_method_create_entity(): void
    {
        $stub = DebtStub::random();
        
        $debt = DebtFactory::new([
            $stub->debtor->name->value,
            $stub->debtor->governmentId->value,
            $stub->debtor->email->value,
            $stub->amount->value,
            $stub->dueDate->value,
            $stub->transactionId->value,
        ]);

        $this->assertInstanceOf(Debt::class, $debt);
        $this->assertEquals($stub->transactionId->value, $debt->transactionId->value);
        $this->assertEquals($stub->amount->value, $debt->amount->value);
        $this->assertEquals($stub->dueDate->value, $debt->dueDate->value);
        $this->assertEquals($stub->debtor->name->value, $debt->debtor->name->value);
        $this->assertEquals($stub->debtor->governmentId->value, $debt->debtor->governmentId->value);
        $this->assertEquals($stub->debtor->email->value, $debt->debtor->email->value);
    }
}
