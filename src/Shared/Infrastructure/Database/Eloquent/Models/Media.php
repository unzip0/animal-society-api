<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Media extends SpatieMedia
{
    public $incrementing = false;
    protected $table = 'media';
    protected $primaryKey = 'uuid';

    public function id(): string
    {
        return $this->uuid;
    }

    public function modelType(): string
    {
        return $this->model_type;
    }

    public function modelId(): string|int
    {
        return $this->model_id;
    }

    public function collectionName(): string
    {
        return $this->collection_name;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function getFileName(): string
    {
        return $this->file_name;
    }

    public function size(): int
    {
        return $this->size;
    }

    public function mimeType(): string
    {
        return $this->mime_type;
    }

    public function diskName(): string
    {
        return $this->disk;
    }

    public function conversionsDiskName(): string
    {
        return $this->conversions_disk;
    }
}
