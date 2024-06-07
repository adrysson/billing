<?php

namespace App\Infraestructure\Providers;

use App\Domain\Contracts\DebtBatchesProcessor;
use App\Domain\Contracts\DebtNotifier;
use App\Infraestructure\Repositories\InMemory\InMemoryDebtRepository;
use App\Infraestructure\Processors\JobBasedDebtBatchProcessor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        DebtNotifier::class => InMemoryDebtRepository::class,
        DebtBatchesProcessor::class => JobBasedDebtBatchProcessor::class,
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
