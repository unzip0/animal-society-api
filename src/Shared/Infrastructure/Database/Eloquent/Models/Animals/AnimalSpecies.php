<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Animals;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 */
class AnimalSpecies extends Model
{
    public $incrementing = false;
    protected $table = 'animal_species';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'name',
    ];

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function races(): HasMany
    {
        return $this->hasMany(AnimalRace::class, 'species_id');
    }
}
