<?php

namespace App\Presentation\Http\Controllers;

use App\Domain\Contracts\DebtBatchesProcessor;
use App\Presentation\Http\Controller;
use Generator;
use Illuminate\Http\Request;

class ProcessBillingController extends Controller
{
    private const BATCH_SIZE = 2000;

    public function __construct(
        private readonly DebtBatchesProcessor $debtBatchesProcessor,
    ) {
    }

    public function index(Request $request)
    {
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file')->getRealPath();

            $batchs = $this->getBatches($file);
    
            $this->debtBatchesProcessor->processBatch($batchs);
        
            return response()->json([
                'message' => "File processed successfully",
            ]);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }

    private function getBatches(string $filePath): Generator
    {
        if (($handle = fopen($filePath, 'r')) !== false) {
            fgetcsv($handle);
            $batch = [];
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $batch[] = $data;

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