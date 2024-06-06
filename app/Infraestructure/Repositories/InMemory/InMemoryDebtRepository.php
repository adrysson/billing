<?php

namespace App\Infraestructure\Repositories\InMemory;

use App\Domain\Entities\Debt;
use App\Domain\Services\DebtNotifier;
use Illuminate\Log\Logger;

class InMemoryDebtRepository implements DebtNotifier
{
    public function __construct(
        private readonly Logger $logger,
    ) {  
    }

    public function notify(Debt $debt)
    {
        $this->logger->info('E-mail enviado', $debt->jsonSerialize());
    }
}