<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Jwt;

use AnimalSociety\Shared\Domain\Jwt\JwtManagerContract;

final class JwtManager implements JwtManagerContract
{
    private string $secretKey;

    public function __construct()
    {
        $this->secretKey = config('jwt.secret');
    }

    public function generateToken(string $payload): string
    {
        $base64UrlHeader = $this->base64UrlEncode((string) json_encode([
            'alg' => 'HS256',
            'typ' => 'JWT',
        ]));
        $base64UrlPayload = $this->base64UrlEncode((string) json_encode($payload));
        $base64UrlSignature = hash_hmac('sha256', sprintf(
            '%s.%s',
            $base64UrlHeader,
            $base64UrlPayload
        ), $this->secretKey, true);
        $base64UrlSignature = $this->base64UrlEncode($base64UrlSignature);

        return sprintf(
            '%s.%s.%s',
            $base64UrlHeader,
            $base64UrlPayload,
            $base64UrlSignature,
        );
    }

    /**
     * @return array<string,mixed>
     */
    public function decodeToken(string $token): array
    {
        list(, $base64UrlPayload, ) = explode('.', $token);
        $payload = $this->base64UrlDecode($base64UrlPayload);

        return json_decode($payload, true);
    }

    public function validateToken(string $token): bool
    {
        list($base64UrlHeader, $base64UrlPayload, $base64UrlSignature) = explode('.', $token);

        $signature = $this->base64UrlDecode($base64UrlSignature);
        $expectedSignature = hash_hmac('sha256', sprintf(
            '%s.%s',
            $base64UrlHeader,
            $base64UrlPayload
        ), $this->secretKey, true);

        return hash_equals($signature, $expectedSignature);
    }

    private function base64UrlEncode(string $data): string
    {
        $base64 = base64_encode($data);
        $base64Url = strtr($base64, '+/', '-_');
        return rtrim($base64Url, '=');
    }

    private function base64UrlDecode(string $data): string
    {
        $base64 = strtr($data, '-_', '+/');
        $base64Padded = str_pad($base64, strlen($base64) % 4, '=', STR_PAD_RIGHT);
        return (string) base64_decode($base64Padded, true);
    }
}
