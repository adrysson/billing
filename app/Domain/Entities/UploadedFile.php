<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\CreatedAt;
use App\Domain\ValueObjects\UploadedFileId;
use App\Domain\ValueObjects\UploadedFileName;
use JsonSerializable;

class UploadedFile implements JsonSerializable
{
    public function __construct(
        public readonly ?UploadedFileId $id,
        public readonly UploadedFileName $name,
        public readonly CreatedAt $createdAt,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id?->value,
            'name' => $this->name->value,
            'created_at' => $this->createdAt->value,
        ];
    }
}
