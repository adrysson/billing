<?php

namespace Tests\Stubs\Domain\ValueObjects;

use App\Domain\ValueObjects\DebtStatus;
use Faker\Factory;

class DebtStatusStub
{
    public static function random(): DebtStatus
    {
        $faker = Factory::create();

        return new DebtStatus($faker->randomElement(DebtStatus::ALL));
    }
}
