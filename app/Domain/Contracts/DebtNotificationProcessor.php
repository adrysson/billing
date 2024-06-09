<?php

namespace App\Domain\Contracts;

use App\Domain\Entities\Debt;

interface DebtNotificationProcessor
{
    public function processNotificationDebt(Debt $debt): void;
}