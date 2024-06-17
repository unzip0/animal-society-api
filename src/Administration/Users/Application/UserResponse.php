<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application;

final readonly class UserResponse
{
    public function __construct(
        private string $id,
        private string $name,
        private string $firstLastName,
        private string $secondLastName,
        private string $email,
        private string $role,
        private bool $active,
    ) {}

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

    public function role(): string
    {
        return $this->role;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function active(): bool
    {
        return $this->active;
    }
}
