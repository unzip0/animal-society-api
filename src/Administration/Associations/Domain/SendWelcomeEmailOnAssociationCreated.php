<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain;

use AnimalSociety\Shared\Domain\Bus\Event\DomainEventSubscriber;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

final class SendWelcomeEmailOnAssociationCreated implements DomainEventSubscriber
{
    public function __invoke(AssociationCreatedDomainEvent $event): void
    {
        dd($event);
        Mail::to('apcabrera08@gmail.com')->send(new TestMail());
    }

    public static function subscribedTo(): array
    {
        return [AssociationCreatedDomainEvent::class];
    }
}
