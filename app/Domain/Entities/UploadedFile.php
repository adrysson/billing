<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\CreatedAt;
use App\Domain\ValueObjects\UploadedFileId;
use App\Domain\ValueObjects\UploadedFileName;
use App\Domain\ValueObjects\UploadedFileRealPath;
use App\Domain\ValueObjects\UploadedFileStatus;
use JsonSerializable;

class UploadedFile implements JsonSerializable
{
    public function __construct(
        private ?UploadedFileId $id,
        public readonly UploadedFileName $name,
        public readonly UploadedFileRealPath $realPath,
        private UploadedFileStatus $status,
        public readonly CreatedAt $createdAt,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id?->value,
            'name' => $this->name->value,
            'real_path' => $this->realPath->value,
            'status' => $this->status->value,
            'created_at' => $this->createdAt->value,
        ];
    }

    public function created(UploadedFileId $id): void
    {
        $this->id = $id;

        $this->status = UploadedFileStatus::created();
    }

    public function processed(): void
    {
        $this->status = UploadedFileStatus::processed();
    }

    public function status(): UploadedFileStatus
    {
        return $this->status;
    }

    public function id(): ?UploadedFileId
    {
        return $this->id;
    }
}
