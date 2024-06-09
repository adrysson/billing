<?php

namespace Tests\Unit\Application\Services;

use App\Application\Services\DebtNotificationService;
use App\Domain\Contracts\DebtNotifier;
use App\Domain\Repositories\DebtRepository;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entities\DebtStub;

class DebtNotificationServiceTest extends TestCase
{
    public function test_not_throw_exception_when_not_has_errors()
    {
        $this->expectNotToPerformAssertions();

        $debtNotifier = Mockery::mock(DebtNotifier::class);

        $debtRepository = Mockery::mock(DebtRepository::class);
        $debtRepository->shouldReceive('update')->once();

        $service = new DebtNotificationService($debtNotifier, $debtRepository);

        $debt = DebtStub::random();

        $debtNotifier->shouldReceive('notify')->with($debt)->once();

        $service->notifyDebt($debt);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}
