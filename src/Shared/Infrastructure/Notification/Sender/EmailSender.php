<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Notification\Sender;

use AnimalSociety\Shared\Domain\Notification\Sender\Sender;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final readonly class EmailSender implements Sender
{
    public function __construct(
        private MailerInterface $mailer
    ) {}

    public function send(
        string $recipient,
        string $subject,
        string $message
    ): void {
        $email = (new Email())
            ->from('apcabrera08@gmail.com')
            ->to($recipient)
            ->subject($subject)
            ->text($message);

        $this->mailer->send($email);
    }
}
