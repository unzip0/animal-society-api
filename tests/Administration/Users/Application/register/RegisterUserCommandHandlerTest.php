<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Application\register;

use AnimalSociety\Administration\Associations\Application\find\AssociationFinder;
use AnimalSociety\Administration\Associations\Domain\Association;
use AnimalSociety\Administration\Associations\Domain\AssociationRepository;
use AnimalSociety\Administration\Associations\Domain\Exception\AssociationEmailInvalidException;
use AnimalSociety\Administration\Users\Application\find\UserFinder;
use AnimalSociety\Administration\Users\Application\register\RegisterUserCommandHandler;
use AnimalSociety\Administration\Users\Application\register\UserRegister;
use AnimalSociety\Administration\Users\Domain\Exception\UserEmailAreadyUsedException;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationMother;
use AnimalSociety\Tests\Administration\Users\Domain\UserAssociationIdMother;
use AnimalSociety\Tests\Administration\Users\Domain\UserEmailMother;
use AnimalSociety\Tests\Administration\Users\Domain\UserMother;
use AnimalSociety\Tests\Administration\Users\UsersModuleUnitTestCase;
use AnimalSociety\Tests\CreatesApplication;
use Mockery\MockInterface;

final class RegisterUserCommandHandlerTest extends UsersModuleUnitTestCase
{
    use CreatesApplication;
    private RegisterUserCommandHandler|null $handler;
    private AssociationRepository|MockInterface|null $associationRepository;
    private Association|MockInterface|null $association;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var AssociationRepository $this */
        $this->associationRepository = $this->mock(AssociationRepository::class);
        $this->association = AssociationMother::create();

        $this->handler = new RegisterUserCommandHandler(
            new UserRegister(
                $this->repository(),
                new AssociationFinder($this->associationRepository),
                new UserFinder($this->repository())
            )
        );
    }

    public function testItShouldRegisterUser(): void
    {
        $userEmail = UserEmailMother::create(
            $this->association->associationEmail()->value()
        );
        $userAssociationId = UserAssociationIdMother::create(
            $this->association->id()->value()
        );
        $command = RegisterUserCommandMother::create(
            email: $userEmail,
            userAssociationId: $userAssociationId,
        );
        $user = UserMother::fromRequest($command);

        $this->shouldNotFindOneByCriteria([
            'email' => $user->email()->value(),
        ]);

        $this->associationRepository
            ->shouldReceive('findOneBy')
            ->with([
                'id' => $user->associationId()->value(),
                'email' => $user->email()->value(),
            ])->andReturn($this->association);

        $this->shouldCreate($user);

        $this->dispatch($command, $this->handler);
    }

    public function testItShouldRegisterUserWhenGettingAssociationByEmail(): void
    {
        $userEmail = UserEmailMother::create();
        $command = RegisterUserCommandMother::create(
            email: $userEmail,
            userAssociationId: null,
        );
        $user = UserMother::fromRequest($command);

        $this->associationRepository
            ->shouldReceive('findOneBy')
            ->with([
                'email' => $user->email()->value(),
            ])->andReturn($this->association);

        $this->shouldNotFindOneByCriteria([
            'email' => $user->email()->value(),
        ]);

        $this->associationRepository
            ->shouldReceive('findOneBy')
            ->with([
                'id' => $user->associationId()->value(),
                'email' => $user->email()->value(),
            ])->andReturn($this->association);

        $this->shouldCreate($user);

        $this->dispatch($command, $this->handler);
    }

    public function testItShouldThrowExceptionWhenUserEmailAlreadyExists(): void
    {
        $userEmail = UserEmailMother::create();
        $command = RegisterUserCommandMother::create(
            email: $userEmail,
        );
        $user = UserMother::fromRequest($command);

        $this->shouldFindOneByCriteria([
            'email' => $user->email()->value(),
        ], $user);

        $this->expectException(UserEmailAreadyUsedException::class);
        $this->dispatch($command, $this->handler);
    }

    public function testItShouldThrowExceptionWhenAssociationEmailIsInvalid(): void
    {
        $userEmail = UserEmailMother::create();
        $userAssociationId = UserAssociationIdMother::create();
        $command = RegisterUserCommandMother::create(
            email: $userEmail,
            userAssociationId: $userAssociationId,
        );
        $user = UserMother::fromRequest($command);

        $this->shouldNotFindOneByCriteria([
            'email' => $user->email()->value(),
        ]);

        $this->associationRepository
            ->shouldReceive('findOneBy')
            ->with([
                'id' => $user->associationId()->value(),
                'email' => $user->email()->value(),
            ])->andReturnNull();

        $this->expectException(AssociationEmailInvalidException::class);
        $this->dispatch($command, $this->handler);
    }
}
