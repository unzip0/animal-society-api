<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsRaces\Application\create;

use AnimalSociety\Shared\Domain\Bus\Command\Command;

final readonly class CreateAnimalRaceCommand implements Command
{
    public function __construct(
        private string $id,
        private string $name,
        private string $speciesId,
    ) {}

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
        return $this->speciesId;
    }
}
