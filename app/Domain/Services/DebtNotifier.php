<?php

namespace App\Domain\Services;

use App\Domain\Entities\Debt;

interface DebtNotifier
{
    public function notify(Debt $debt);
}