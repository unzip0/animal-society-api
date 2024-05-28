<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $cif
 * @property string $name
 * @property int $city_id
 * @property string $email
 * @property bool $active
 */
class Association extends Model
{
    public $incrementing = false;
    protected $table = 'associations';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'cif',
        'name',
        'city_id',
        'email',
        'active',
    ];

    /**
     * @var array<string,mixed>
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    public function id(): string
    {
        return $this->id;
    }

    public function cif(): string
    {
        return $this->cif;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function cityId(): int
    {
        return $this->city_id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'association_id', 'id');
    }
}
