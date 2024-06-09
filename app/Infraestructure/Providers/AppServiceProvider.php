<?php

namespace App\Infraestructure\Providers;

use App\Domain\Contracts\BillingFileReader;
use App\Domain\Contracts\DebtBatchesProcessor;
use App\Domain\Contracts\DebtNotificationProcessor;
use App\Domain\Contracts\DebtNotifier;
use App\Domain\Repositories\UploadedFileRepository;
use App\Infraestructure\FileReaders\CsvFileReader;
use App\Infraestructure\Notifier\InMemory\InMemoryDebtRepository;
use App\Infraestructure\Processors\JobBasedDebtBatchProcessor;
use App\Infraestructure\Processors\JobBasedDebtNotificationProcessor;
use App\Infraestructure\Repositories\Eloquent\EloquentUploadedFileRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        DebtNotifier::class => InMemoryDebtRepository::class,
        DebtBatchesProcessor::class => JobBasedDebtBatchProcessor::class,
        UploadedFileRepository::class => EloquentUploadedFileRepository::class,
        DebtNotificationProcessor::class => JobBasedDebtNotificationProcessor::class,
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
