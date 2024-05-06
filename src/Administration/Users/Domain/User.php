<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Domain;

use AnimalSociety\Shared\Domain\Aggregate\AggregateRoot;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
final class User extends AggregateRoot implements
    JWTSubject,
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use MustVerifyEmail;

    public function __construct(
        /**
         * @ORM\Id
         * @ORM\Column(name="id", type="string")
         */
        private readonly string $id,
        /**
         * @ORM\Column(name="name", type="string",)
         */
        private readonly string $name,
        /**
         * @ORM\Column(name="first_last_name", type="string",)
         */
        private readonly string $firstLastName,
        /**
         * @ORM\Column(name="second_last_name", type="string",)
         */
        private readonly string $secondLastName,
        /**
         * @ORM\Column(name="email", type="string", unique=true)
         */
        private readonly string $email,
        /**
         * @ORM\Column(name="password", type="string",)
         */
        private readonly string $password,
        /**
         * @ORM\Column(name="association_id", type="string")
         */
        private readonly string $associationId,
        /**
         * @ORM\Column(name="role", type="string",)
         */
        private readonly string $role,
        /**
         * @ORM\Column(name="active", type="boolean")
         */
        private readonly bool $active,
    ) {}

    public static function create(
        string $id,
        string $name,
        string $firstLastName,
        string $secondLastName,
        string $email,
        string $password,
        string $associationId,
        string $role,
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

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function firstLastName(): string
    {
        return $this->firstLastName;
    }

    public function secondLastName(): string
    {
        return $this->secondLastName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function associationId(): string
    {
        return $this->associationId;
    }

    public function role(): string
    {
        return $this->role;
    }

    public function getJWTIdentifier()
    {
        return $this->id();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
