<?php

namespace App\Application\Commands;

use App\Domain\Factories\DebtFactory;
use App\Domain\Repositories\DebtRepository;

class DebtsExpireCommand
{
    private const EXPIRE_DAYS = 7;
    private const BATCH_SIZE = 1000;

    public function __construct(
        private readonly DebtRepository $debtRepository,
    ) {
    }

    public function execute(): void
    {
        $expiredChargeDebts = $this->debtRepository->fetchExpiredCharge(
            expireDays: self::EXPIRE_DAYS,
            count: self::BATCH_SIZE,
        );

        foreach ($expiredChargeDebts as $data) {
            $debt = DebtFactory::createFromStore($data);

            $debt->expired();

            $this->debtRepository->update($debt);
        }
    }
}