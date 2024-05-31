<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Animals;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $name
 * @property string $species_id
 */
class AnimalRace extends Model
{
    public $incrementing = false;
    protected $table = 'animal_races';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'name',
        'species_id',
    ];

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function speciesId(): string
    {
        return $this->species_id;
    }

    public function species(): BelongsTo
    {
        return $this->belongsTo(AnimalSpecies::class, 'species_id');
    }
}
