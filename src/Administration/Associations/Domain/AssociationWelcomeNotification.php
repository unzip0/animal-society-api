<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain;

use AnimalSociety\Shared\Domain\Notification\Notification;

final class AssociationWelcomeNotification extends Notification
{
    public function __construct(
        private readonly string $associationName,
        private readonly string $associationEmail,
    ) {}

    public function getSubject(): string
    {
        return 'Welcome to Animal Society';
    }

    public function getBody(): ?string
    {
        return null;
    }

    public function template(): string
    {
        return 'email.association.welcome';
    }

    /**
     * @return array<string, mixed>
     */
    public function data(): array
    {
        return [
            'name' => $this->associationName,
            'email' => $this->associationEmail,
        ];
    }
}
