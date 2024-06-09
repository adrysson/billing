<?php

namespace App\Infraestructure\Jobs;

use App\Domain\Contracts\DebtBatchesProcessor;
use App\Domain\Contracts\DebtNotificationProcessor;
use App\Domain\Factories\DebtFactory;
use Generator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use InvalidArgumentException;

class ProcessBatchJob implements ShouldQueue, DebtBatchesProcessor
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public readonly array $batch = [])
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DebtNotificationProcessor $debtNotificationProcessor)
    {
        foreach ($this->batch as $row) {
            $data = str_getcsv($row);

            try {
                $debt = DebtFactory::createFromArray($data);
            } catch (InvalidArgumentException) {
                continue;
            }

            $debtNotificationProcessor->processNotificationDebt($debt);
        }
    }

    public function processBatch(Generator $batches): void
    {
        foreach ($batches as $batch) {
            self::dispatch($batch)->onQueue('debt-batch-processing');
        }
    }
}
