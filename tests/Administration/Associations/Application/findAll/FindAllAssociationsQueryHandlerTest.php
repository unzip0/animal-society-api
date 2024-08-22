<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Associations\Application\findAll;

use AnimalSociety\Administration\Associations\Application\findAll\AssociationSearcher;
use AnimalSociety\Administration\Associations\Application\findAll\FindAllAssociationsQueryHandler;
use AnimalSociety\Tests\Administration\Associations\AssociationsModuleUnitTestCase;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationMother;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationsResponseMother;

final class FindAllAssociationsQueryHandlerTest extends AssociationsModuleUnitTestCase
{
    private FindAllAssociationsQueryHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new FindAllAssociationsQueryHandler(
            new AssociationSearcher(
                $this->repository(),
            )
        );
    }

    public function testItShouldReturnAllAssociations(): void
    {
        $query = FindAllAssociationsQueryMother::create();
        $association = AssociationMother::create();
        $response = AssociationsResponseMother::create($association);

        $this->shouldFindAll($association);

        $this->assertAskResponse($response, $query, $this->handler);
    }
}
