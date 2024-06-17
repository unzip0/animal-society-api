<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use AnimalSociety\Administration\Users\Domain\Exception\UserNotAllowedException;
use AnimalSociety\Administration\Users\Domain\UserRole;
use AnimalSociety\Shared\Domain\Exception\Auth\UserNotAuthenticatedException;
use AnimalSociety\Shared\Infrastructure\Jwt\JwtManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminUserAllowed
{
    public const string MIDDLEWARE_NAME = 'super-admin-allowed';

    public function __construct(
        private readonly JwtManager $jwtManager
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authorizationToken = current($request->header()['authorization'] ?? []);
        if (!(bool) $authorizationToken) {
            throw UserNotAuthenticatedException::create();
        }

        $headerRole = $this->getHeaderRole($authorizationToken);

        if ($headerRole === null) {
            throw UserNotAllowedException::create();
        }

        $this->validateUserIsSuperAdmin($headerRole);

        return $next($request);
    }

    public static function middlewareName(): string
    {
        return self::MIDDLEWARE_NAME;
    }

    private function getHeaderRole(string $authorizationToken): ?string
    {
        $decodedToken = $this->jwtManager->decodeToken($authorizationToken);

        return $decodedToken['role'] ?? null;
    }

    private function validateUserIsSuperAdmin(
        string $role,
    ): void {
        if (!in_array($role, UserRole::allowedAdminRoles(), true)) {
            throw UserNotAllowedException::create();
        }
    }
}
