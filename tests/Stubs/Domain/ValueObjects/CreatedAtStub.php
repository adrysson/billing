<?php

namespace Tests\Stubs\Domain\ValueObjects;

use App\Domain\ValueObjects\CreatedAt;
use Faker\Factory;

class CreatedAtStub
{
    public static function random(): CreatedAt
    {
        $faker = Factory::create();

        return new CreatedAt($faker->date('Y-m-d H:i:s'));
    }
}
