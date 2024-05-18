<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Notification\Notifiable;

interface Notifiable
{
    public const string EMAIL_CHANNEL = 'email';

    /**
     * @return string[]
     */
    public function getNotificationChannels(): array;

    public function routeNotificationFor(string $channel): string;
}
