<?php

namespace App\Application\Commands;

use App\Domain\Contracts\DebtNotificationProcessor;
use App\Domain\Factories\DebtFactory;
use App\Domain\Repositories\DebtRepository;
use App\Domain\ValueObjects\DebtStatus;

class DebtsChargeCommand
{
    private const BATCH_SIZE = 1000;

    public function __construct(
        private readonly DebtRepository $debtRepository,
        private readonly DebtNotificationProcessor $debtNotificationProcessor,
    ) {
    }

    public function execute(): void
    {
        $debts = $this->debtRepository->fetchByStatus(
            status: DebtStatus::canCharge(),
            count: self::BATCH_SIZE,
        );

        foreach ($debts as $data) {
            $debt = DebtFactory::createFromStore($data);

            $this->debtNotificationProcessor->processNotificationDebt($debt);
        }
    }
}