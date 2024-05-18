<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Notification\Sender;

interface Sender
{
    public function send(string $recipient, string $subject, string $message): void;
}
