<?php

namespace Tests\Unit\Infraestructure\FileReaders;

use App\Domain\ValueObjects\UploadedFileRealPath;
use App\Infraestructure\FileReaders\CsvFileReader;
use PHPUnit\Framework\TestCase;

class CsvFileReaderTest extends TestCase
{
    private function createTempCsvFile(string $content): string
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'csv_test_');
        file_put_contents($tempFile, $content);
        return $tempFile;
    }

    private function deleteTempFile(string $filePath): void
    {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    public function test_get_batches_should_return_rows_batches()
    {
        $csvContent = "header1,header2\nvalue1,value2\nvalue3,value4\nvalue5,value6\n";
        
        $filePath = $this->createTempCsvFile($csvContent);
        $realPath = new UploadedFileRealPath($filePath);

        $reader = new CsvFileReader();

        $batches = iterator_to_array($reader->getBatches($realPath));

        $this->assertCount(1, $batches);
        $this->assertCount(3, $batches[0]);
        $this->assertEquals("value1,value2\n", $batches[0][0]);
        $this->assertEquals("value3,value4\n", $batches[0][1]);
        $this->assertEquals("value5,value6\n", $batches[0][2]);

        $this->deleteTempFile($filePath);
    }

    public function test_get_batches_should_return_rows_batches_when_has_multiple_batches()
    {
        $csvContent = "header1,header2\n" . str_repeat("value1,value2\n", 1002);

        $filePath = $this->createTempCsvFile($csvContent);
        $realPath = new UploadedFileRealPath($filePath);

        $reader = new CsvFileReader();

        $batches = iterator_to_array($reader->getBatches($realPath));

        $this->assertCount(2, $batches);
        $this->assertCount(1000, $batches[0]);
        $this->assertCount(2, $batches[1]);
        $this->assertEquals("value1,value2\n", $batches[1][0]);
        $this->assertEquals("value1,value2\n", $batches[1][1]);

        $this->deleteTempFile($filePath);
    }
}
