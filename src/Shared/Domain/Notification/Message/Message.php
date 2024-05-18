<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Notification\Message;

final class Message
{
    public function __construct(
        protected string $subject,
        protected string $body
    ) {}

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
