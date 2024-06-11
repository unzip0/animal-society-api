<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Application\update;

use AnimalSociety\Shared\Domain\Bus\Command\Command;

final readonly class UpdateAnimalCommand implements Command
{
    public function __construct(
        private string $id,
        private string $associationId,
        private string $name,
        private string $speciesId,
        private string $raceId,
        private int $age,
        private ?string $photoPath,
        private ?string $photoName,
        private ?string $photoMimeType,
        private ?string $photoExtension,
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function associationId(): string
    {
        return $this->associationId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function speciesId(): string
    {
        return $this->speciesId;
    }

    public function raceId(): string
    {
        return $this->raceId;
    }

    public function age(): int
    {
        return $this->age;
    }

    public function photoPath(): ?string
    {
        return $this->photoPath;
    }

    public function photoName(): ?string
    {
        return $this->photoName;
    }

    public function photoMimeType(): ?string
    {
        return $this->photoMimeType;
    }

    public function photoExtension(): ?string
    {
        return $this->photoExtension;
    }
}
