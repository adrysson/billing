<?php

namespace App\Application\Commands;

use App\Domain\Contracts\DebtNotificationProcessor;
use App\Domain\Factories\DebtFactory;
use App\Domain\Repositories\DebtRepository;

class DebtsChargeCommand
{
    private const EXPIRE_DAYS = 7;
    private const BATCH_SIZE = 1000;

    public function __construct(
        private readonly DebtRepository $debtRepository,
        private readonly DebtNotificationProcessor $debtNotificationProcessor,
    ) {
    }

    public function execute(): void
    {
        $overdueDebts = $this->debtRepository->fetchOverdue(
            expireDays: self::EXPIRE_DAYS,
            count: self::BATCH_SIZE,
        );

        foreach ($overdueDebts as $data) {
            $debt = DebtFactory::createFromStore($data);

            $this->debtNotificationProcessor->processNotificationDebt($debt);
        }
    }
}