<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Domain;

use AnimalSociety\Shared\Domain\Aggregate\AggregateRoot;
use AnimalSociety\Shared\Domain\Mapper\Domain;

final class User extends AggregateRoot implements Domain
{
    public function __construct(
        private readonly UserId $id,
        private UserName $name,
        private UserFirstLastName $firstLastName,
        private UserSecondLastName $secondLastName,
        private UserEmail $email,
        private UserPassword $password,
        private readonly UserAssociationId $associationId,
        private readonly UserRole $role,
        private bool $active,
    ) {}

    public static function create(
        UserId $id,
        UserName $name,
        UserFirstLastName $firstLastName,
        UserSecondLastName $secondLastName,
        UserEmail $email,
        UserPassword $password,
        UserAssociationId $associationId,
        UserRole $role,
    ): self {
        $user = new self(
            id: $id,
            name: $name,
            firstLastName: $firstLastName,
            secondLastName: $secondLastName,
            email: $email,
            password: $password,
            associationId: $associationId,
            role: $role,
            active: true,
        );

        //record UserCreatedDomainEvent

        return $user;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function firstLastName(): UserFirstLastName
    {
        return $this->firstLastName;
    }

    public function secondLastName(): UserSecondLastName
    {
        return $this->secondLastName;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function associationId(): UserAssociationId
    {
        return $this->associationId;
    }

    public function role(): UserRole
    {
        return $this->role;
    }

    public function isActive(): bool
    {
        return $this->active === true;
    }

    public function updateEmail(UserEmail $email): void
    {
        $this->email = $email;
    }

    public function updatePassword(UserPassword $password): void
    {
        $this->password = $password;
    }

    public function updateName(UserName $name): void
    {
        $this->name = $name;
    }

    public function updateFirstLastName(UserFirstLastName $firstLastName): void
    {
        $this->firstLastName = $firstLastName;
    }

    public function updateSecondLastName(UserSecondLastName $secondLastName): void
    {
        $this->secondLastName = $secondLastName;
    }

    public function updateActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id()->__toString(),
            'name' => $this->name()->value(),
            'first_last_name' => $this->firstLastName()->value(),
            'second_last_name' => $this->secondLastName()->value(),
            'email' => $this->email()->value(),
            'association_id' => $this->associationId()->__toString(),
            'role' => $this->role()->value(),
            'active' => $this->isActive(),
        ];
    }

    /**
     * @return array<string,mixed>
     */
    public function transform(): array
    {
        return array_merge([
            'password' => $this->password()->value(),
        ], $this->toArray());
    }
}
