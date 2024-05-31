<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Animals;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $animal_id
 * @property string $file_name
 * @property string $file_path
 * @property string $file_extension
 * @property string $file_mime_type
 * @property string $url
 */
class AnimalPhoto extends Model
{
    public $incrementing = false;
    protected $table = 'animal_photos';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'animal_id',
        'file_name',
        'file_path',
        'file_extension',
        'file_mime_type',
        'url',
    ];

    public function id(): string
    {
        return $this->id;
    }

    public function animalId(): string
    {
        return $this->animal_id;
    }

    public function fileName(): string
    {
        return $this->file_name;
    }

    public function filePath(): string
    {
        return $this->file_path;
    }

    public function fileExtension(): string
    {
        return $this->file_extension;
    }

    public function fileMimeType(): string
    {
        return $this->file_mime_type;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }
}
