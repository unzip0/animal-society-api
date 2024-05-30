<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\register;

use AnimalSociety\Administration\Associations\Application\find\AssociationFinder;
use AnimalSociety\Administration\Associations\Domain\Association;
use AnimalSociety\Administration\Associations\Domain\Exception\AssociationEmailInvalidException;
use AnimalSociety\Administration\Users\Application\find\UserFinder;
use AnimalSociety\Administration\Users\Domain\Exception\UserEmailAreadyUsedException;
use AnimalSociety\Administration\Users\Domain\User;
use AnimalSociety\Administration\Users\Domain\UserAssociationId;
use AnimalSociety\Administration\Users\Domain\UserEmail;
use AnimalSociety\Administration\Users\Domain\UserFirstLastName;
use AnimalSociety\Administration\Users\Domain\UserId;
use AnimalSociety\Administration\Users\Domain\UserName;
use AnimalSociety\Administration\Users\Domain\UserPassword;
use AnimalSociety\Administration\Users\Domain\UserRepository;
use AnimalSociety\Administration\Users\Domain\UserRole;
use AnimalSociety\Administration\Users\Domain\UserSecondLastName;
use AnimalSociety\Shared\Domain\Bus\Event\EventBus;

final readonly class UserRegister
{
    public function __construct(
        private UserRepository $repository,
        private AssociationFinder $associationFinder,
        private UserFinder $userFinder,
        // private EventBus $bus,
    ) {}

    public function __invoke(
        string $id,
        string $name,
        string $firstLastName,
        string $secondLastName,
        string $email,
        string $password,
        string $role,
        ?string $associationId,
    ): void {
        if ($associationId === null) {
            $associationId = $this->getAssociationIdByEmail($email);
        }

        $this->checkUserConstraints($email, $associationId);

        $user = User::create(
            id: new UserId($id),
            name: new UserName($name),
            firstLastName: new UserFirstLastName($firstLastName),
            secondLastName: new UserSecondLastName($secondLastName),
            email: new UserEmail($email),
            password: new UserPassword(bcrypt($password)),
            associationId: new UserAssociationId($associationId),
            role: new UserRole($role),
        );

        $this->repository->create($user);

        // $this->bus->publish(...$user->pullDomainEvents());
    }

    private function checkUserConstraints(
        string $email,
        ?string $associationId,
    ): void {
        $usersWithSameEmail = $this->userFinder->__invoke([
            'email' => $email,
        ]);

        if ($usersWithSameEmail instanceof User) {
            throw UserEmailAreadyUsedException::create();
        }

        $associationWithEmail = $this->associationFinder->__invoke([
            'email' => $email,
            'id' => $associationId,
        ]);

        if ($associationWithEmail === null) {
            throw AssociationEmailInvalidException::create();
        }
    }

    private function getAssociationIdByEmail(string $email): string
    {
        /** @var Association|null $associationWithEmail */
        $associationWithEmail = $this->associationFinder->__invoke([
            'email' => $email,
        ]);

        if ($associationWithEmail === null) {
            throw AssociationEmailInvalidException::create();
        }

        return $associationWithEmail->id()->__toString();
    }
}
