<?php

namespace App\Application\Services;

use App\Domain\Contracts\DebtNotifier;
use App\Domain\Entities\Debt;

class DebtNotificationService
{
    public function __construct(
        private readonly DebtNotifier $debtNotifier,
    ) {
    }

    public function notifyDebt(Debt $debt): void
    {
        $this->debtNotifier->notify($debt);
    }
}