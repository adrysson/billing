<?php

namespace Tests\Stubs\Domain\ValueObjects;

use App\Domain\ValueObjects\UploadedFileId;
use Faker\Factory;

class UploadedFileIdStub
{
    public static function random(): UploadedFileId
    {
        $faker = Factory::create();

        return new UploadedFileId($faker->randomNumber());
    }
}
