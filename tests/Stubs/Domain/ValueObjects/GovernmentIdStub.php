<?php

namespace Tests\Stubs\Domain\ValueObjects;

use App\Domain\ValueObjects\GovernmentId;
use Faker\Factory;

class GovernmentIdStub
{
    public static function random(): GovernmentId
    {
        $faker = Factory::create();

        return new GovernmentId($faker->randomNumber(4, true));
    }
}
