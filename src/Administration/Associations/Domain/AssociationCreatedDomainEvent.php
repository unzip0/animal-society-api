<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain;

use AnimalSociety\Shared\Domain\Bus\Event\DomainEvent;

final class AssociationCreatedDomainEvent extends DomainEvent
{
    public function __construct(
        string $aggregateId,
        private readonly Association $association,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($aggregateId, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'association.created';
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent {
        return new self(
            $aggregateId,
            $body['association'],
            $eventId,
            $occurredOn
        );
    }

    public function toPrimitives(): array
    {
        return [
            'name' => $this->association->associationName(),
            'email' => $this->association->associationEmail(),
        ];
    }

    public function association(): Association
    {
        return $this->association;
    }
}
