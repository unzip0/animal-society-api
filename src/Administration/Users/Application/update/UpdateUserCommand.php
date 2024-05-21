<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\update;

use AnimalSociety\Shared\Domain\Bus\Command\Command;

final readonly class UpdateUserCommand implements Command
{
    public function __construct(
        private string $id,
        private string $name,
        private string $firstLastName,
        private string $secondLastName,
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
}
