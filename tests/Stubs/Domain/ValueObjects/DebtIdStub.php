<?php

namespace Tests\Stubs\Domain\ValueObjects;

use App\Domain\ValueObjects\DebtId;
use Faker\Factory;

class DebtIdStub
{
    public static function random(): DebtId
    {
        $faker = Factory::create();

        return new DebtId($faker->uuid());
    }
}
