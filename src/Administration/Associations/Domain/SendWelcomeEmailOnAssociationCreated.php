<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain;

use AnimalSociety\Shared\Domain\Bus\Event\DomainEventSubscriber;
use AnimalSociety\Shared\Domain\Notification\Notifier\NotifierInterface;

final class SendWelcomeEmailOnAssociationCreated implements DomainEventSubscriber
{
    public function __construct(
        private NotifierInterface $notifier
    ) {}

    public function __invoke(AssociationCreatedDomainEvent $event): void
    {
        /** @var Association $association */
        $association = $event->association();
        $this->notifier->notify(
            $association,
            new AssociationWelcomeNotification(
                $association->associationName(),
                $association->associationEmail()
            ),
        );
    }

    /**
     * @return string[]
     */
    public static function subscribedTo(): array
    {
        return [AssociationCreatedDomainEvent::class];
    }
}
