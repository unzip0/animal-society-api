<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Jwt;

interface JwtManagerContract
{
    public function generateToken(string $payload): string;

    /**
     * @return array<string,mixed>
     */
    public function decodeToken(string $token): array;

    public function validateToken(string $token): bool;
}
