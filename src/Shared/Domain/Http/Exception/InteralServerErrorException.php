<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Http\Exception;

final class InteralServerErrorException extends ApiResponseException
{
    public const int CODE = 500;
    public const string MESSAGE = 'internal server error';
    public const int HTTP_STATUS = 500;
}
