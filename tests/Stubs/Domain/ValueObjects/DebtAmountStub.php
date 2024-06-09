<?php

namespace Tests\Stubs\Domain\ValueObjects;

use App\Domain\ValueObjects\DebtAmount;

class DebtAmountStub
{
    public static function random(): DebtAmount
    {
        return new DebtAmount(mt_rand());
    }
}
