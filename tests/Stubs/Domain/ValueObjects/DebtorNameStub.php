<?php

namespace Tests\Stubs\Domain\ValueObjects;

use App\Domain\ValueObjects\DebtorName;
use Faker\Factory;

class DebtorNameStub
{
    public static function random(): DebtorName
    {
        $faker = Factory::create();

        return new DebtorName($faker->name());
    }
}
