<?php

namespace Tests\Unit\Infraestructure\FileReaders;

use App\Application\Services\DebtNotificationService;
use App\Infraestructure\Jobs\ProcessDebtNotificationJob;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entities\DebtStub;

class ProcessDebtNotificationJobTest extends TestCase
{
    public function test_not_throw_exception_when_not_has_errors()
    {
        $this->expectNotToPerformAssertions();

        $debtNotificationService = Mockery::mock(DebtNotificationService::class);

        $debt = DebtStub::random();

        $job = new ProcessDebtNotificationJob($debt);

        $debtNotificationService->shouldReceive('notifyDebt')->with($debt)->once();

        $job->handle($debtNotificationService);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}
