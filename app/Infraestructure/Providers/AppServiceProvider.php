<?php

namespace App\Infraestructure\Providers;

use App\Domain\Contracts\BillingFileReader;
use App\Domain\Contracts\DebtNotificationProcessor;
use App\Domain\Contracts\DebtNotifier;
use App\Domain\Contracts\DebtStoreBatchesProcessor;
use App\Domain\Contracts\DebtStoreProcessor;
use App\Domain\Repositories\DebtRepository;
use App\Domain\Repositories\UploadedFileRepository;
use App\Infraestructure\FileReaders\CsvFileReader;
use App\Infraestructure\Notifiers\Mail\MailDebtNotifier;
use App\Infraestructure\Processors\JobBased\JobBasedDebtNotificationProcessor;
use App\Infraestructure\Processors\JobBased\JobBasedDebtStoreBatchProcessor;
use App\Infraestructure\Processors\JobBased\JobBasedDebtStoreProcessor;
use App\Infraestructure\Repositories\Eloquent\EloquentDebtRepository;
use App\Infraestructure\Repositories\Eloquent\EloquentUploadedFileRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        DebtNotifier::class => MailDebtNotifier::class,
        BillingFileReader::class => CsvFileReader::class,

        // Repositories
        DebtRepository::class => EloquentDebtRepository::class,
        UploadedFileRepository::class => EloquentUploadedFileRepository::class,

        // Processors
        DebtStoreBatchesProcessor::class => JobBasedDebtStoreBatchProcessor::class,
        DebtNotificationProcessor::class => JobBasedDebtNotificationProcessor::class,
        DebtStoreProcessor::class => JobBasedDebtStoreProcessor::class,
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
    }
}
