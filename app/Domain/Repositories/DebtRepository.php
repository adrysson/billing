<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Debt;

interface DebtRepository
{
    public function store(Debt $debt): void;
}
