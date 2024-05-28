<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Mapper;

interface Domain
{
    /**
     * @return array<string,mixed>
     */
    public function transform(): array;
}
