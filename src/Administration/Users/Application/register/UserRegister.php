<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\register;

use AnimalSociety\Administration\Associations\Application\find\AssociationFinder;
use AnimalSociety\Administration\Associations\Domain\Exception\AssociationEmailInvalidException;
use AnimalSociety\Administration\Users\Application\find\UserFinder;
use AnimalSociety\Administration\Users\Domain\Exception\UserEmailAreadyUsedException;
use AnimalSociety\Administration\Users\Domain\User;
use AnimalSociety\Administration\Users\Domain\UserRepository;
use AnimalSociety\Shared\Domain\Bus\Event\EventBus;
use AnimalSociety\Shared\Domain\Criteria\Criteria;
use AnimalSociety\Shared\Domain\Criteria\Filters;
use AnimalSociety\Shared\Domain\Criteria\Order;

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
        string $associationId,
    ): void {
        $this->checkUserContraints($email, $associationId);

        $user = User::create(
            id: $id,
            name: $name,
            firstLastName: $firstLastName,
            secondLastName: $secondLastName,
            email: $email,
            password: bcrypt($password),
            associationId: $associationId,
            role: $role,
        );

        $this->repository->save($user);

        // $this->bus->publish(...$user->pullDomainEvents());
    }

    private function checkUserContraints(
        string $email,
        string $associationId,
    ): void {
        $usersWithSameEmail = $this->userFinder->__invoke(
            new Criteria(
                filters: Filters::fromValues([
                    [
                        'field' => 'email',
                        'operator' => '=',
                        'value' => $email,
                    ],
                ]),
                order: Order::fromValues(null, null),
                offset: null,
                limit: null
            )
        );

        if ($usersWithSameEmail !== []) {
            throw UserEmailAreadyUsedException::create();
        }

        $associationWithEmail = $this->associationFinder->__invoke(
            new Criteria(
                filters: Filters::fromValues([
                    [
                        'field' => 'associationEmail',
                        'operator' => '=',
                        'value' => $email,
                    ],
                    [
                        'field' => 'associationId',
                        'operator' => '=',
                        'value' => $associationId,
                    ],
                ]),
                order: Order::fromValues(null, null),
                offset: null,
                limit: null
            )
        );

        if ($associationWithEmail === []) {
            throw AssociationEmailInvalidException::create();
        }
    }
}
