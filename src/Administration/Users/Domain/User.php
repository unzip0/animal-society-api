<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Domain;

use AnimalSociety\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
final class User extends AggregateRoot implements JWTSubject, AuthenticatableContract
{
    /** User have to be decoupled from authentication interfaces */
    use Authenticatable;

    public function __construct(
        /**
         * @ORM\Id
         * @ORM\Column(name="id", type="string")
         */
        private readonly string $id,
        /**
         * @ORM\Column(name="name", type="string",)
         */
        private string $name,
        /**
         * @ORM\Column(name="first_last_name", type="string",)
         */
        private string $firstLastName,
        /**
         * @ORM\Column(name="second_last_name", type="string",)
         */
        private string $secondLastName,
        /**
         * @ORM\Column(name="email", type="string", unique=true)
         */
        private string $email,
        /**
         * @ORM\Column(name="password", type="string",)
         */
        private string $password,
        /**
         * @ORM\Column(name="association_id", type="string")
         */
        private readonly string $associationId,
        /**
         * @ORM\Column(name="role", type="string",)
         */
        private readonly string $role,
        /**
         * @ORM\Column(name="active", type="boolean")
         */
        private bool $active,
    ) {}

    public static function create(
        string $id,
        string $name,
        string $firstLastName,
        string $secondLastName,
        string $email,
        string $password,
        string $associationId,
        string $role,
    ): self {
        $user = new self(
            id: $id,
            name: $name,
            firstLastName: $firstLastName,
            secondLastName: $secondLastName,
            email: $email,
            password: $password,
            associationId: $associationId,
            role: $role,
            active: true,
        );

        //record UserCreatedDomainEvent

        return $user;
    }

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
        return $this->firstLastName;
    }

    public function secondLastName(): string
    {
        return $this->secondLastName;
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
        return $this->associationId;
    }

    public function role(): string
    {
        return $this->role;
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
        return [];
    }

    public function isActive(): bool
    {
        return $this->active === true;
    }

    public function updateEmail(string $email): void
    {
        $this->email = $email;
    }

    public function updatePassword(string $password): void
    {
        $this->password = $password;
    }

    public function updateName(string $name): void
    {
        $this->name = $name;
    }

    public function updateFirstLastName(string $firstLastName): void
    {
        $this->firstLastName = $firstLastName;
    }

    public function updateSecondLastName(string $secondLastName): void
    {
        $this->secondLastName = $secondLastName;
    }

    public function updateActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'first_last_name' => $this->firstLastName(),
            'second_last_name' => $this->secondLastName(),
            'email' => $this->email(),
            'association_id' => $this->associationId(),
            'role' => $this->role(),
            'active' => $this->isActive(),
        ];
    }

    /**
     * @return array<string,mixed>
     */
    public function profile(): array
    {
        return array_merge([
            'active' => $this->isActive(),
        ], $this->toArray());
    }
}
