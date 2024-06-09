<?php

namespace Tests\Feature;

use App\Domain\ValueObjects\UploadedFileStatus;
use App\Infraestructure\Jobs\ProcessDebtStoreBatchJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProcessBillingRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_requires_a_csv_file()
    {
        $response = $this->postJson('/upload-file', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('csv_file');
    }

    public function test_it_accepts_only_csv_files()
    {
        Storage::fake('local');

        $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        $response = $this->postJson('/upload-file', [
            'csv_file' => $file,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('csv_file');
    }

    public function test_it_accepts_valid_csv_files()
    {
        Storage::fake('local');
        Queue::fake();

        $filePath = base_path('tests/Fixtures/input.csv');
        $file = new UploadedFile($filePath, 'input.csv', 'text/csv', null, true);

        $startTime = microtime(true);

        $response = $this->postJson('/upload-file', [
            'csv_file' => $file,
        ]);

        $endTime = microtime(true);

        $executionTime = $endTime - $startTime;

        $response->assertStatus(200);

        Queue::assertPushed(ProcessBatchJob::class, function (ProcessBatchJob $job) {
            return !empty($job->batch);
        });

        $this->assertDatabaseHas('uploaded_files', [
            'name' => $file->getClientOriginalName(),
            'real_path' => $file->getRealPath(),
            'status' => UploadedFileStatus::processed()->value,
        ]);

        $this->assertLessThan(5, $executionTime, 'O tempo de execução excedeu 5 segundos');
    }
}
