<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Application;

final readonly class AssociationResponse
{
    public function __construct(
        private string $id,
        private string $cif,
        private string $name,
        private string $email,
        private int $cityId,
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

    public function email(): string
    {
        return $this->email;
    }

    public function cityId(): int
    {
        return $this->cityId;
    }
}
