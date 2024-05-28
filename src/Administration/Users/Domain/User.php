<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Domain;

use AnimalSociety\Shared\Domain\Aggregate\AggregateRoot;
use AnimalSociety\Shared\Domain\Mapper\Domain;

final class User extends AggregateRoot implements Domain
{
    public function __construct(
        private readonly string $id,
        private string $name,
        private string $firstLastName,
        private string $secondLastName,
        private string $email,
        private string $password,
        private readonly string $associationId,
        private readonly string $role,
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
    public function transform(): array
    {
        return array_merge([
            'password' => $this->password(),
        ], $this->toArray());
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
