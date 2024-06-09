<?php

namespace App\Domain\Contracts;

use App\Domain\Entities\Debt;

interface DebtStoreProcessor
{
    public function processStoreDebt(Debt $debt): void;
}