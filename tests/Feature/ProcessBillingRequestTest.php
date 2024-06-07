<?php

namespace Tests\Feature;

use App\Infraestructure\Jobs\ProcessBatchJob;
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
        $response = $this->postJson('/billing/upload-csv', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('csv_file');
    }

    public function test_it_accepts_only_csv_files()
    {
        Storage::fake('local');

        $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        $response = $this->postJson('/billing/upload-csv', [
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

        $response = $this->postJson('/billing/upload-csv', [
            'csv_file' => $file,
        ]);

        $response->assertStatus(200);

        Queue::assertPushed(ProcessBatchJob::class, function ($job) use ($file) {
            return !empty($job->batch);
        });
    }
}
