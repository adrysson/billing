<?php

namespace App\Presentation\Http\Controllers;

use App\Application\FetchUploadedFilesQuery;
use App\Presentation\Http\Controller;
use App\Presentation\Http\Requests\FetchUploadFilesRequest;
use Illuminate\Http\JsonResponse;

class FetchUploadFilesController extends Controller
{
    public function __construct(
        private readonly FetchUploadedFilesQuery $fetchUploadedFilesQuery,
    ) {
    }

    public function index(FetchUploadFilesRequest $request): JsonResponse
    {
        $files = $this->fetchUploadedFilesQuery->execute(
            $request->get('id'),
            $request->get('name'),
            $request->get('status'),
            $request->get('created_at'),
            $request->get('page')
        );

        return response()->json($files);
    }
}