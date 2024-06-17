<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use AnimalSociety\Administration\Users\Domain\Exception\UserNotAllowedException;
use AnimalSociety\Shared\Domain\Exception\Auth\UserNotAuthenticatedException;
use AnimalSociety\Shared\Infrastructure\Jwt\JwtManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowedUserInAssociation
{
    public const string MIDDLEWARE_NAME = 'allowed-user-in-association';

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
        $requested = $request->all();
        $requestedAssociationId = $requested['association_id'] ?? null;
        $authorizationToken = current($request->header()['authorization'] ?? []);
        if (!(bool) $authorizationToken) {
            throw UserNotAuthenticatedException::create();
        }

        $headerAssociationId = $this->getHeaderAssociationId($authorizationToken);

        if (!$requestedAssociationId) {
            $request['association_id'] = $headerAssociationId;
            return $next($request);
        }

        $this->validateAssociationUser(
            $requestedAssociationId,
            $headerAssociationId,
        );

        return $next($request);
    }

    public static function middlewareName(): string
    {
        return self::MIDDLEWARE_NAME;
    }

    private function getHeaderAssociationId(string $authorizationToken): ?string
    {
        $decodedToken = $this->jwtManager->decodeToken($authorizationToken);

        return $decodedToken['association_id'] ?? null;
    }

    private function validateAssociationUser(
        string $associationId,
        string $headerAssociationId,
    ): void {
        if ($associationId !== $headerAssociationId) {
            throw UserNotAllowedException::create();
        }
    }
}
