<?php

namespace Tests\Unit\Infraestructure\Models;

use App\Infraestructure\Models\UploadedFile;
use PHPUnit\Framework\TestCase;

class UploadedFileTest extends TestCase
{
    public function test_fillable_attributes()
    {
        $uploadedFile = new UploadedFile();

        $fillable = ['name', 'real_path', 'status', 'created_at'];
        
        $this->assertEquals($fillable, $uploadedFile->getFillable());
    }

    public function test_casts()
    {
        $uploadedFile = new UploadedFile();

        $casts = [
            'id' => 'int',
            'created_at' => 'datetime'
        ];
        
        $this->assertEquals($casts, $uploadedFile->getCasts());
    }
}
