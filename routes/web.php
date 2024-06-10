<?php

use App\Presentation\Http\Controllers\FetchUploadFilesController;
use App\Presentation\Http\Controllers\ProcessBillingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function() {
    Route::post('/upload-file', [ProcessBillingController::class, 'index']);
    Route::get('/uploaded-files', [FetchUploadFilesController::class, 'index']);
});
