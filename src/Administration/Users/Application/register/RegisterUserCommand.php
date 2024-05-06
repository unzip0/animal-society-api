<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\register;

use AnimalSociety\Shared\Domain\Bus\Command\Command;

final readonly class RegisterUserCommand implements Command
{
    public function __construct(
        private string $id,
        private string $name,
        private string $firstLastName,
        private string $secondLastName,
        private string $email,
        private string $password,
        private string $role,
        private string $associationId,
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

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function role(): string
    {
        return $this->role;
    }

    public function associationId(): string
    {
        return $this->associationId;
    }
}
