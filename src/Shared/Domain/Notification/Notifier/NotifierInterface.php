<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Notification\Notifier;

use AnimalSociety\Shared\Domain\Notification\Notifiable\Notifiable;
use AnimalSociety\Shared\Domain\Notification\Notification;

interface NotifierInterface
{
    public function notify(Notifiable $notifiable, Notification $notification): void;
}
