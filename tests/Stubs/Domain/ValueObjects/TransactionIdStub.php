<?php

namespace Tests\Stubs\Domain\ValueObjects;

use App\Domain\ValueObjects\TransactionId;
use Faker\Factory;

class TransactionIdStub
{
    public static function random(): TransactionId
    {
        $faker = Factory::create();

        return new TransactionId($faker->uuid());
    }
}
