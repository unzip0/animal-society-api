<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Notification;

abstract class Notification
{
    abstract public function getSubject(): string;

    abstract public function getBody(): ?string;

    abstract public function template(): string;

    /**
     * @return array<string, mixed>
     */
    abstract public function data(): array;
}
