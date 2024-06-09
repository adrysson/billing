<?php

namespace Tests\Stubs\Domain\ValueObjects;

use App\Domain\ValueObjects\UploadedFileName;
use Faker\Factory;

class UploadedFileNameStub
{
    public static function random(): UploadedFileName
    {
        $faker = Factory::create();

        return new UploadedFileName($faker->word() . '.csv');
    }
}
