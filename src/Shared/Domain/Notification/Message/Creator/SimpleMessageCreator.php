<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Notification\Message\Creator;

use AnimalSociety\Shared\Domain\Notification\Message\Message;
use AnimalSociety\Shared\Domain\Notification\Notification;

class SimpleMessageCreator implements MessageCreator
{
    public function createMessage(Notification $notification): Message
    {
        return new Message(
            $notification->getSubject(),
            $notification->getBody()
        );
    }
}
