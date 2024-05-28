<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain;

use AnimalSociety\Shared\Domain\Aggregate\AggregateRoot;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Domain\Notification\Notifiable\Notifiable;

final class Association extends AggregateRoot implements Notifiable, Domain
{
    public function __construct(
        private readonly string $associationId,
        private readonly string $associationCif,
        private readonly string $associationName,
        private readonly int $associationCityId,
        private readonly string $associationEmail,
        private readonly bool $associationActive,
    ) {}

    public static function create(
        string $associationId,
        string $associationCif,
        string $associationName,
        int $associationCityId,
        string $associationEmail,
    ): self {
        $association = new self(
            associationId: $associationId,
            associationCif: $associationCif,
            associationName: $associationName,
            associationCityId: $associationCityId,
            associationEmail: $associationEmail,
            associationActive: true,
        );

        $association->record(new AssociationCreatedDomainEvent(
            aggregateId: $association->id(),
            association: $association,
        ));

        return $association;
    }

    public function id(): string
    {
        return $this->associationId;
    }

    public function associationCif(): string
    {
        return $this->associationCif;
    }

    public function associationName(): string
    {
        return $this->associationName;
    }

    public function associationCityId(): int
    {
        return $this->associationCityId;
    }

    public function associationEmail(): string
    {
        return $this->associationEmail;
    }

    public function isActive(): bool
    {
        return $this->associationActive === true;
    }

    public function getNotificationChannels(): array
    {
        return [Notifiable::EMAIL_CHANNEL];
    }

    public function routeNotificationFor(string $channel): string
    {
        return $this->associationEmail;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'cif' => $this->associationCif(),
            'name' => $this->associationName(),
            'city_id' => $this->associationCityId(),
            'email' => $this->associationEmail(),
            'active' => $this->isActive(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function transform(): array
    {
        return $this->toArray();
    }
}
