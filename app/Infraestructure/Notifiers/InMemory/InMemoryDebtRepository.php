<?php

namespace App\Infraestructure\Notifiers\InMemory;

use App\Domain\Contracts\DebtNotifier;
use App\Domain\Entities\Debt;
use Illuminate\Log\Logger;

class InMemoryDebtRepository implements DebtNotifier
{
    public function __construct(
        private readonly Logger $logger,
    ) {  
    }

    public function notify(Debt $debt)
    {
        $this->logger->info('E-mail enviado: ' . $debt->debtor->email->value);
    }
}