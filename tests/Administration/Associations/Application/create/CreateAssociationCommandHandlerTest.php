<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Associations\Application\create;

use AnimalSociety\Administration\Associations\Application\create\AssociationCreator;
use AnimalSociety\Administration\Associations\Application\create\CreateAssociationCommandHandler;
use AnimalSociety\Administration\Associations\Domain\Exception\AssociationCifAlreadyExistsException;
use AnimalSociety\Administration\Associations\Domain\Exception\AssociationEmailInvalidException;
use AnimalSociety\Tests\Administration\Associations\AssociationsModuleUnitTestCase;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationCreatedDomainEventMother;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationMother;
use AnimalSociety\Tests\CreatesApplication;

final class CreateAssociationCommandHandlerTest extends AssociationsModuleUnitTestCase
{
    use CreatesApplication;
    private CreateAssociationCommandHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new CreateAssociationCommandHandler(
            new AssociationCreator(
                $this->repository(),
                $this->eventBus()
            )
        );
    }

    public function testItShouldCreateAValidAssociation(): void
    {
        $command = CreateAssociationCommandMother::create();

        $association = AssociationMother::fromRequest($command);
        $domainEvent = AssociationCreatedDomainEventMother::fromAssociation($association);

        $this->shouldNotFindOneByCriteria([
            'cif' => $association->associationCif()->value(),
        ]);

        $this->shouldNotFindOneByCriteria([
            'email' => $association->associationEmail()->value(),
        ]);

        $this->shouldCreate($association);
        $this->shouldPublishDomainEvent($domainEvent);

        $this->dispatch($command, $this->handler);
    }

    public function testItShouldThrowExceptionIfCifAlreadyExists(): void
    {
        $command = CreateAssociationCommandMother::create();
        $association = AssociationMother::fromRequest($command);

        $this->shouldFindOneByCriteria(
            [
                'cif' => $association->associationCif()->value(),
            ],
            $association,
        );
        $this->expectException(AssociationCifAlreadyExistsException::class);
        $this->dispatch($command, $this->handler);
    }

    public function testItShouldThrowExceptionIfEmailAlreadyExists(): void
    {
        $command = CreateAssociationCommandMother::create();
        $association = AssociationMother::fromRequest($command);

        $this->shouldNotFindOneByCriteria(
            [
                'cif' => $association->associationCif()->value(),
            ],
        );

        $this->shouldFindOneByCriteria(
            [
                'email' => $association->associationEmail()->value(),
            ],
            $association,
        );
        $this->expectException(AssociationEmailInvalidException::class);
        $this->dispatch($command, $this->handler);
    }
}
