<?php

namespace Tests\Stubs\Domain\ValueObjects;

use App\Domain\ValueObjects\DebtDueDate;
use Faker\Factory;

class DebtDueDateStub
{
    public static function random(): DebtDueDate
    {
        $faker = Factory::create();

        return new DebtDueDate($faker->date());
    }
}
