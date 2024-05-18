<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain;

use AnimalSociety\Shared\Domain\Aggregate\AggregateRoot;
use AnimalSociety\Shared\Domain\Notification\Notifiable\Notifiable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="associations")
 */
final class Association extends AggregateRoot implements Notifiable
{
    public function __construct(
        /**
         * @ORM\Id
         * @ORM\Column(name="id", type="string")
         */
        private readonly string $associationId,
        /**
         * @ORM\Column(name="cif", type="string", unique=true)
         */
        private readonly string $associationCif,
        /**
         * @ORM\Column(name="name", type="string",)
         */
        private readonly string $associationName,
        /**
         * @ORM\Column(name="city_id", type="integer")
         */
        private readonly int $associationCityId,
        /**
         * @ORM\Column(name="email", type="string", unique=true)
         */
        private readonly string $associationEmail,
        /**
         * @ORM\Column(name="active", type="boolean")
         */
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
}
