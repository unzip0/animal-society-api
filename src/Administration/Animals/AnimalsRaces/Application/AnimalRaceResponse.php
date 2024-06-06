<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsRaces\Application;

final readonly class AnimalRaceResponse
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
