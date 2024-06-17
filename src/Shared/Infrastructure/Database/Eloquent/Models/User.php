<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

/**
 * @property string $id
 * @property string $name
 * @property string $first_last_name
 * @property string $second_last_name
 * @property string $email
 * @property string $password
 * @property string $association_id
 * @property string $role
 * @property bool $active
 * @property Association $association
 */
class User extends Model implements JWTSubject, AuthenticatableContract
{
    use Authenticatable;
    public $incrementing = false;
    protected $table = 'users';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'name',
        'first_last_name',
        'second_last_name',
        'email',
        'password',
        'association_id',
        'role',
        'active',
    ];
    protected $hidden = [
        'password',
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

    public function name(): string
    {
        return $this->name;
    }

    public function firstLastName(): string
    {
        return $this->first_last_name;
    }

    public function secondLastName(): string
    {
        return $this->second_last_name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function associationId(): string
    {
        return $this->association_id;
    }

    public function role(): string
    {
        return $this->role;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function association(): HasOne
    {
        return $this->hasOne(Association::class, 'id', 'association_id');
    }

    public function getJWTIdentifier(): string
    {
        return $this->id();
    }

    /**
     * @return mixed[]
     */
    public function getJWTCustomClaims(): array
    {
        return [
            'association_id' => $this->association->id(),
            'role' => $this->role(),
        ];
    }
}
