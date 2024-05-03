<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Application\create;

use AnimalSociety\Shared\Domain\Bus\Command\Command;

final readonly class CreateAssociationCommand implements Command
{
    public function __construct(
        private string $id,
        private string $cif,
        private string $name,
        private int $cityId,
        private string $email,
    ) {}

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
        return $this->cityId;
    }

    public function email(): string
    {
        return $this->email;
    }
}
