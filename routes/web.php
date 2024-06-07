<?php

use App\Presentation\Http\Controllers\ProcessBillingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/billing/upload-csv', [ProcessBillingController::class, 'index']);