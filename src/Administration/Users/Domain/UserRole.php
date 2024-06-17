<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Domain;

use AnimalSociety\Administration\Users\Domain\Exception\UserInvalidRoleException;
use AnimalSociety\Shared\Domain\ValueObject\StringValueObject;

final class UserRole extends StringValueObject
{
    private const string ROLE_SUPER = 'super';
    private const string ROLE_ADMIN = 'admin';
    private const string ROLE_SUPPORT = 'support';
    private const array USER_ROLES = [
        self::ROLE_SUPER,
        self::ROLE_ADMIN,
        self::ROLE_SUPPORT,
    ];

    public function __construct(string $value)
    {
        parent::__construct($value);

        $this->roleExists($value);
    }

    public function isSuper(): bool
    {
        return $this->value === self::ROLE_SUPER;
    }

    public function isAdmin(): bool
    {
        return $this->value === self::ROLE_ADMIN;
    }

    public function isSupport(): bool
    {
        return $this->value === self::ROLE_SUPPORT;
    }

    /**
     * @return string[]
     */
    public static function allowedAdminRoles(): array
    {
        return [
            self::ROLE_SUPER,
            self::ROLE_ADMIN,
        ];
    }

    private function roleExists(string $role): void
    {
        if (!in_array($role, self::USER_ROLES, true)) {
            throw UserInvalidRoleException::create();
        }
    }
}
