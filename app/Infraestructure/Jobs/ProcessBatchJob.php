<?php

namespace App\Infraestructure\Jobs;

use App\Application\DebtNotificationService;
use App\Domain\Factories\DebtFactory;
use Generator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessBatchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected array $batch)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DebtNotificationService $debtNotificationService)
    {
        foreach ($this->batch as $row) {
            $debt = DebtFactory::createFromArray($row);

            $debtNotificationService->notifyDebt($debt);
        }
    }
}