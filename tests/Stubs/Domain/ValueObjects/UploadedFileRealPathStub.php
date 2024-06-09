<?php

namespace Tests\Stubs\Domain\ValueObjects;

use App\Domain\ValueObjects\UploadedFileName;
use App\Domain\ValueObjects\UploadedFileRealPath;
use Faker\Factory;

class UploadedFileRealPathStub
{
    public static function random(): UploadedFileRealPath
    {
        $faker = Factory::create();

        return new UploadedFileRealPath('/tmp/' . $faker->word() . '.csv');
    }
}
