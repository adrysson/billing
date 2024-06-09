<?php

namespace App\Infraestructure\Jobs;

use App\Domain\Contracts\DebtStoreProcessor;
use App\Domain\Entities\Debt;
use App\Domain\Repositories\DebtRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessDebtStoreJob implements ShouldQueue, DebtStoreProcessor
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public readonly Debt $debt)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DebtRepository $debtRepository)
    {
        $debtRepository->store($this->debt);
    }

    public function processStoreDebt(Debt $debt): void
    {
        self::dispatch($debt)->onQueue('debt-store-processing');
    }
}
