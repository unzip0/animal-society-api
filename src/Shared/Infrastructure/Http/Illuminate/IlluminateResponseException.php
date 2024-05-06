<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Http\Illuminate;

use Illuminate\Http\Exceptions\HttpResponseException;

class IlluminateResponseException extends HttpResponseException
{
    public const int CODE = 0;
    public const string MESSAGE = 'message exception';
    public const int HTTP_STATUS = 400;

    public static function create(
        ?string $message = null,
        ?int $code = null,
        int $httpStattus = null,
    ): self {
        return new self(
            IlluminateApiResponse::create(
                [
                    'code' => $code ?? static::CODE,
                    'message' => $message ?? static::MESSAGE,
                ],
                $httpStattus ?? static::HTTP_STATUS,
            )
        );
    }
}
