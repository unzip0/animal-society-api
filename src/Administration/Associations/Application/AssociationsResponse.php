<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Application;

use AnimalSociety\Shared\Domain\Bus\Query\Response;

final class AssociationsResponse implements Response
{
    /**
     * @var AssociationResponse[]
     */
    private readonly array $associations;

    public function __construct(AssociationResponse ...$associations)
    {
        $this->associations = $associations;
    }

    /**
     * @return AssociationResponse[]
     */
    public function associations(): array
    {
        return $this->associations;
    }

    /**
     * @return array<array<string,mixed>>
     */
    public function toArray(): array
    {
        return array_map(
            fn (AssociationResponse $association): array => [
                'id' => $association->id(),
                'cif' => $association->cif(),
                'name' => $association->name(),
                'email' => $association->email(),
                'city_id' => $association->cityId(),
            ],
            $this->associations()
        );
    }
}
