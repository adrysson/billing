<?php

namespace App\Application\Services;

use App\Domain\Contracts\DebtNotifier;
use App\Domain\Entities\Debt;
use App\Domain\Repositories\DebtRepository;

class DebtNotificationService
{
    public function __construct(
        private readonly DebtNotifier $debtNotifier,
        private readonly DebtRepository $debtRepository,
    ) {
    }

    public function notifyDebt(Debt $debt): void
    {
        $this->debtNotifier->notify($debt);

        $debt->charged();

        $this->debtRepository->update($debt);
    }
}