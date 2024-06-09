<?php

namespace App\Infraestructure\Providers;

use App\Domain\Contracts\BillingFileReader;
use App\Domain\Contracts\DebtBatchesProcessor;
use App\Domain\Contracts\DebtNotificationProcessor;
use App\Domain\Contracts\DebtNotifier;
use App\Domain\Repositories\UploadedFileRepository;
use App\Infraestructure\FileReaders\CsvFileReader;
use App\Infraestructure\Jobs\ProcessBatchJob;
use App\Infraestructure\Jobs\ProcessDebtNotificationJob;
use App\Infraestructure\Notifiers\InMemory\InMemoryDebtRepository;
use App\Infraestructure\Repositories\Eloquent\EloquentUploadedFileRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        DebtNotifier::class => InMemoryDebtRepository::class,
        DebtBatchesProcessor::class => ProcessBatchJob::class,
        UploadedFileRepository::class => EloquentUploadedFileRepository::class,
        DebtNotificationProcessor::class => ProcessDebtNotificationJob::class,
        BillingFileReader::class => CsvFileReader::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
