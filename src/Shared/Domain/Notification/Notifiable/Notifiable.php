<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Notification\Notifiable;

interface Notifiable
{
    /**
     * @return string[]
     */
    public function getNotificationChannels(): array;

    public function routeNotificationFor(string $channel): string;
}
