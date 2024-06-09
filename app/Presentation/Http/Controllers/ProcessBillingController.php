<?php

namespace App\Presentation\Http\Controllers;

use App\Application\Commands\BillingProcessingCommand;
use App\Domain\Factories\UploadedFileFactory;
use App\Presentation\Http\Controller;
use App\Presentation\Http\Requests\ProcessBillingRequest;

class ProcessBillingController extends Controller
{
    public function __construct(
        private readonly BillingProcessingCommand $billingProcessingCommand,
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

        $this->billingProcessingCommand->execute($uploadedFile);

        return response()->json([
            'message' => "File processed successfully",
        ]);
    }
}