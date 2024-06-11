<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Application\delete;

use AnimalSociety\Shared\Domain\Bus\Command\Command;

final readonly class DeleteAnimalCommand implements Command
{
    public function __construct(
        private string $animaId,
        private string $associationId,
    ) {}

    public function animalId(): string
    {
        return $this->animaId;
    }

    public function associationId(): string
    {
        return $this->associationId;
    }
}
