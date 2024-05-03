<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Application\create;

use AnimalSociety\Administration\Associations\Application\find\AssociationFinder;
use AnimalSociety\Administration\Associations\Domain\Association;
use AnimalSociety\Administration\Associations\Domain\AssociationRepository;
use AnimalSociety\Shared\Domain\Bus\Event\EventBus;
use AnimalSociety\Shared\Domain\Criteria\Criteria;
use AnimalSociety\Shared\Domain\Criteria\Filters;
use AnimalSociety\Shared\Domain\Criteria\Order;
use RuntimeException;

final readonly class AssociationCreator
{
    public function __construct(
        private AssociationRepository $repository,
        private AssociationFinder $associationFinder,
        // private EventBus $bus,
    ) {}

    public function __invoke(
        string $id,
        string $cif,
        string $name,
        int $cityId,
        string $email,
    ): void {
        $association = Association::create(
            associationId: $id,
            associationCif: $cif,
            associationName: $name,
            associationCityId: $cityId,
            associationEmail: $email,
        );

        $associationWithSameCif = $this->associationFinder->__invoke(
            new Criteria(
                filters: Filters::fromValues([
                    [
                        'field' => 'associationCif',
                        'operator' => '=',
                        'value' => $association->associationCif(),
                    ],
                ]),
                order: Order::fromValues(null, null),
                offset: null,
                limit: null
            )
        );

        if ($associationWithSameCif !== []) {
            throw new RuntimeException('CIF already exists', 400);
        }

        $this->repository->save($association);

        // $this->bus->publish(...$association->pullDomainEvents());
    }
}
