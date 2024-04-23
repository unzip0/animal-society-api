<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Bus\Event;

interface DomainEventSubscriber
{
    /**
     * @return string[]
     */
    public static function subscribedTo(): array;
}
