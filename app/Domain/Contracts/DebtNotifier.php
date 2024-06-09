<?php

namespace App\Domain\Contracts;

use App\Domain\Entities\Debt;

interface DebtNotifier
{
    public function notify(Debt $debt);
}