<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Notification\Message\Creator;

use AnimalSociety\Shared\Domain\Notification\Message\Message;
use AnimalSociety\Shared\Domain\Notification\Notification;
use Illuminate\Support\Facades\View;

class BladeMessageCreator implements MessageCreator
{
    public function createMessage(Notification $notification): Message
    {
        $data = $notification->data();
        $html = View::make($notification->template(), $data)->render();

        return new Message(
            $notification->getSubject(),
            $html
        );
    }
}
