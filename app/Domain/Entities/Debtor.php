<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\DebtorName;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\GovernmentId;
use JsonSerializable;

class Debtor implements JsonSerializable
{
    public function __construct(
        public readonly DebtorName $name,
        public readonly Email $email,
        public readonly GovernmentId $governmentId,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name->value,
            'email' => $this->email->value,
            'government_id' => $this->governmentId->value,
        ];
    }
}
