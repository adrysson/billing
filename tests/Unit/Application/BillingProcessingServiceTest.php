<?php

namespace Tests\Unit\Application;

use App\Application\BillingProcessingService;
use App\Domain\Contracts\BillingFileReader;
use App\Domain\Contracts\DebtBatchesProcessor;
use App\Domain\Factories\UploadedFileFactory;
use App\Domain\Repositories\UploadedFileRepository;
use App\Domain\ValueObjects\UploadedFileStatus;
use Generator;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\Stubs\Domain\ValueObjects\UploadedFileNameStub;
use Tests\Stubs\Domain\ValueObjects\UploadedFileRealPathStub;

class BillingProcessingServiceTest extends TestCase
{
    public function test_process_billing_should_change_upload_file_status_to_processed_when_not_has_error()
    {
        $debtBatchesProcessor = Mockery::mock(DebtBatchesProcessor::class);
        $uploadedFileRepository = Mockery::mock(UploadedFileRepository::class);
        $billingFileReader = Mockery::mock(BillingFileReader::class);

        $service = new BillingProcessingService($debtBatchesProcessor, $uploadedFileRepository, $billingFileReader);

        $fileName = UploadedFileNameStub::random();
        $realPath = UploadedFileRealPathStub::random();
        $uploadedFile = UploadedFileFactory::new(
            fileName: $fileName->value,
            realPath: $realPath->value,
        );

        $batches = $this->getBatches();
        
        $uploadedFileRepository->shouldReceive('store')->with($uploadedFile);

        $billingFileReader->shouldReceive('getBatches')->with($uploadedFile->realPath)->andReturn($batches);

        $debtBatchesProcessor->shouldReceive('processBatch')->with($batches);

        $uploadedFile->processed();
        
        $uploadedFileRepository->shouldReceive('update')->with($uploadedFile);

        $service->processBilling($uploadedFile);

        $this->assertEquals(UploadedFileStatus::processed()->value, $uploadedFile->status()->value);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    private function getBatches(): Generator
    {
        yield ['data1', 'data2'];
        yield ['data3', 'data4'];
    }
}
