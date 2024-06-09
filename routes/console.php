<?php

use App\Application\Commands\DebtsChargeCommand;
use App\Application\Commands\DebtsExpireCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function (
    DebtsExpireCommand $debtsExpireCommand,
    DebtsChargeCommand $debtsChargeCommand,
) {
    $debtsExpireCommand->execute();
    $debtsChargeCommand->execute();
})->everyMinute();