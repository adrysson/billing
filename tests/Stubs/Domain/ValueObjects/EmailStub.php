<?php

namespace Tests\Stubs\Domain\ValueObjects;

use App\Domain\ValueObjects\Email;
use Faker\Factory;

class EmailStub
{
    public static function random(): Email
    {
        $faker = Factory::create();

        return new Email($faker->email());
    }
}
