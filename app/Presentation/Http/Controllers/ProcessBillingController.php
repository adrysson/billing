<?php

namespace App\Presentation\Http\Controllers;

use App\Application\DebtBatchService;
use App\Application\UploadedFileStoreService;
use App\Domain\Factories\UploadedFileFactory;
use App\Presentation\Http\Controller;
use App\Presentation\Http\Requests\ProcessBillingRequest;
use Generator;

class ProcessBillingController extends Controller
{
    private const BATCH_SIZE = 1000;

    public function __construct(
        private readonly DebtBatchService $debtBatchService,
        private readonly UploadedFileStoreService $uploadedFileStoreService,
    ) {
    }

    public function index(ProcessBillingRequest $request)
    {
        $file = $request->file('csv_file');

        $fileName = $file->getClientOriginalName();

        $uploadedFile = UploadedFileFactory::new($fileName);

        $this->uploadedFileStoreService->store($uploadedFile);

        $realPath = $file->getRealPath();

        $batchs = $this->getBatches($realPath);

        $this->debtBatchService->processBatch($batchs);
    
        return response()->json([
            'message' => "File processed successfully",
        ]);
    }

    private function getBatches(string $filePath): Generator
    {
        if (($handle = fopen($filePath, 'r')) !== false) {
            fgetcsv($handle);
            $batch = [];
            while (($row = fgets($handle)) !== false) {
                $batch[] = $row;
    
                if (count($batch) >= self::BATCH_SIZE) {
                    yield $batch;
                    $batch = [];
                }
            }

            if (!empty($batch)) {
                yield $batch;
            }

            fclose($handle);
        }
    }
}