<?php

namespace Tests\Unit\Infraestructure\FileReaders;

use App\Domain\Contracts\DebtNotificationProcessor;
use App\Domain\Factories\DebtFactory;
use App\Infraestructure\Jobs\ProcessBatchJob;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entities\DebtStub;

class ProcessBatchJobTest extends TestCase
{
    public function test_not_throw_exception_when_not_has_errors()
    {
        $this->expectNotToPerformAssertions();

        $debtNotificationProcessor = Mockery::mock(DebtNotificationProcessor::class);

        $debt = DebtStub::random();
        $data = [
            $debt->debtor->name->value,
            $debt->debtor->governmentId->value,
            $debt->debtor->email->value,
            $debt->amount->value,
            $debt->dueDate->value,
            $debt->id->value,
        ];
        $batch = [
            implode(',', $data),
        ];

        $job = new ProcessBatchJob($batch);

        $debtFactory = Mockery::mock(DebtFactory::class);
        $debtFactory->shouldReceive('createFromArray')->andReturn($debt);
        $debtNotificationProcessor->shouldReceive('processNotificationDebt')->once();

        app()->instance(DebtFactory::class, $debtFactory);

        $job->handle($debtNotificationProcessor);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}
