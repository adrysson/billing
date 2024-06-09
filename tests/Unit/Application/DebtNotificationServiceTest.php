<?php

namespace Tests\Unit\Application;

use App\Application\DebtNotificationService;
use App\Domain\Contracts\DebtNotifier;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\Entities\DebtStub;

class DebtNotificationServiceTest extends TestCase
{
    public function test_not_throw_exception_when_not_has_errors()
    {
        $this->expectNotToPerformAssertions();

        $debtNotifier = Mockery::mock(DebtNotifier::class);

        $service = new DebtNotificationService($debtNotifier);

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
