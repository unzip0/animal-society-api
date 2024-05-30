<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain;

use AnimalSociety\Shared\Domain\Aggregate\AggregateRoot;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Domain\Notification\Notifiable\Notifiable;

final class Association extends AggregateRoot implements Notifiable, Domain
{
    public function __construct(
        private readonly AssociationId $associationId,
        private readonly AssociationCif $associationCif,
        private readonly AssociationName $associationName,
        private readonly AssociationCityId $associationCityId,
        private readonly AssociationEmail $associationEmail,
        private readonly bool $associationActive,
    ) {}

    public static function create(
        AssociationId $associationId,
        AssociationCif $associationCif,
        AssociationName $associationName,
        AssociationCityId $associationCityId,
        AssociationEmail $associationEmail,
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
            aggregateId: $association->id()->__toString(),
            association: $association,
        ));

        return $association;
    }

    public function id(): AssociationId
    {
        return $this->associationId;
    }

    public function associationCif(): AssociationCif
    {
        return $this->associationCif;
    }

    public function associationName(): AssociationName
    {
        return $this->associationName;
    }

    public function associationCityId(): AssociationCityId
    {
        return $this->associationCityId;
    }

    public function associationEmail(): AssociationEmail
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
        return $this->associationEmail->value();
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id()->__toString(),
            'cif' => $this->associationCif()->value(),
            'name' => $this->associationName()->value(),
            'city_id' => $this->associationCityId()->value(),
            'email' => $this->associationEmail()->value(),
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
