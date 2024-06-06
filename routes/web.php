<?php

use App\Presentation\Http\Controllers\BillingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/billing/upload-csv', [BillingController::class, 'processBillingCsv']);