<?php

namespace App\Infraestructure\Providers;

use App\Domain\Services\DebtNotifier;
use App\Infraestructure\Repositories\InMemory\InMemoryDebtRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        DebtNotifier::class => InMemoryDebtRepository::class,
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
