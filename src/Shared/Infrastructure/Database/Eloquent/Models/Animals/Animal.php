<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Animals;

use AnimalSociety\Shared\Domain\FileSystem\UploadedFile;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Association;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property string $id
 * @property string $association_id
 * @property string $name
 * @property string $species_id
 * @property string $race_id
 * @property int $age
 * @property bool $available
 */
class Animal extends Model implements HasMedia
{
    use InteractsWithMedia;
    public const MORPH_ALIAS = 'animal-society::animal';
    public $incrementing = false;
    protected $table = 'animals';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'association_id',
        'name',
        'species_id',
        'race_id',
        'age',
        'available',
    ];

    /**
     * @var array<string,mixed>
     */
    protected $casts = [
        'available' => 'boolean',
    ];

    public function id(): string
    {
        return $this->id;
    }

    public function associationId(): string
    {
        return $this->association_id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function speciesId(): string
    {
        return $this->species_id;
    }

    public function raceId(): string
    {
        return $this->race_id;
    }

    public function age(): int
    {
        return intval($this->age);
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function species(): BelongsTo
    {
        return $this->belongsTo(AnimalSpecies::class, 'species_id');
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(AnimalRace::class, 'race_id');
    }

    public function association(): BelongsTo
    {
        return $this->belongsTo(Association::class, 'association_id');
    }

    public function defaultMediaCollection(): string
    {
        return UploadedFile::MEDIA_ANIMAL;
    }
}
