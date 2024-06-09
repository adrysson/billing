<?php

namespace Tests\Stubs\Domain\ValueObjects;

use App\Domain\ValueObjects\UploadedFileStatus;
use Faker\Factory;

class UploadedFileStatusStub
{
    public static function random(): UploadedFileStatus
    {
        $faker = Factory::create();

        return new UploadedFileStatus($faker->randomElement(UploadedFileStatus::ALL));
    }
}
