<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Notification\Message;

interface MessageInterface
{
    public function subject(): string;

    public function content(): string;
}
