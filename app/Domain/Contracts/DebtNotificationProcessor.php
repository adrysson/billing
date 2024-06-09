<?php

namespace App\Domain\Contracts;

use App\Domain\Entities\Debt;
use Generator;

interface DebtNotificationProcessor
{
    public function processNotificationDebt(Debt $debt): void;
}