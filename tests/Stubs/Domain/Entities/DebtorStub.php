<?php

namespace Tests\Stubs\Domain\Entities;

use App\Domain\Entities\Debtor;
use App\Domain\ValueObjects\DebtAmount;
use Tests\Stubs\Domain\ValueObjects\DebtorNameStub;
use Tests\Stubs\Domain\ValueObjects\EmailStub;
use Tests\Stubs\Domain\ValueObjects\GovernmentIdStub;

class DebtorStub
{
    public static function random(): Debtor
    {
        return new Debtor(
            name: DebtorNameStub::random(),
            email: EmailStub::random(),
            governmentId: GovernmentIdStub::random(),
        );
    }
}
