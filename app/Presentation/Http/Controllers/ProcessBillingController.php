<?php

namespace App\Presentation\Http\Controllers;

use App\Application\BillingProcessingService;
use App\Domain\Factories\UploadedFileFactory;
use App\Presentation\Http\Controller;
use App\Presentation\Http\Requests\ProcessBillingRequest;

class ProcessBillingController extends Controller
{
    public function __construct(
        private readonly BillingProcessingService $billingProcessingService,
    ) {
    }

    public function index(ProcessBillingRequest $request)
    {
        $file = $request->file('csv_file');

        $fileName = $file->getClientOriginalName();

        $realPath = $file->getRealPath();

        $uploadedFile = UploadedFileFactory::new(
            fileName: $fileName,
            realPath: $realPath,
        );

        $this->billingProcessingService->processBilling($uploadedFile);

        return response()->json([
            'message' => "File processed successfully",
        ]);
    }
}