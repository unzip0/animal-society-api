<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Notification\Notifier;

use AnimalSociety\Shared\Domain\Notification\Message\Creator\MessageCreator;
use AnimalSociety\Shared\Domain\Notification\Notifiable\Notifiable;
use AnimalSociety\Shared\Domain\Notification\Notification;
use AnimalSociety\Shared\Domain\Notification\Sender\Sender;

class Notifier implements NotifierInterface
{
    /**
     * @param array<string, Sender> $senders
     */
    public function __construct(
        protected array $senders,
        protected MessageCreator $messageCreator,
    ) {}

    public function notify(Notifiable $notifiable, Notification $notification): void
    {
        $message = $this->messageCreator->createMessage($notification);

        foreach ($notifiable->getNotificationChannels() as $channel) {
            if (isset($this->senders[$channel])) {
                $this->senders[$channel]->send(
                    $notifiable->routeNotificationFor($channel),
                    $message->getSubject(),
                    $message->getBody()
                );
            }
        }
    }
}
