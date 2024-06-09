<?php

namespace App\Infraestructure\Jobs;

use App\Application\DebtNotificationService;
use App\Domain\Contracts\DebtNotificationProcessor;
use App\Domain\Entities\Debt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessDebtNotificationJob implements ShouldQueue, DebtNotificationProcessor
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
    public function handle(DebtNotificationService $debtNotificationService)
    {
        $debtNotificationService->notifyDebt($this->debt);
    }

    public function processNotificationDebt(Debt $debt): void
    {
        ProcessDebtNotificationJob::dispatch($debt)->onQueue('debt-notification-processing');
    }
}
