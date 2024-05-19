<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Provider\Laravel;

use AnimalSociety\Shared\Domain\Notification\Message\Creator\BladeMessageCreator;
use AnimalSociety\Shared\Domain\Notification\Message\Creator\MessageCreator;
use AnimalSociety\Shared\Domain\Notification\Notifier\Notifier;
use AnimalSociety\Shared\Domain\Notification\Notifier\NotifierInterface;
use AnimalSociety\Shared\Infrastructure\Notification\Sender\EmailSender;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;

class NotificationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MailerInterface::class, function ($app) {
            $transport = Transport::fromDsn(env('MAILER_DSN'));
            return new Mailer($transport);
        });

        $this->app->singleton(EmailSender::class, function ($app) {
            return new EmailSender($app->make(MailerInterface::class));
        });

        $this->app->singleton(NotifierInterface::class, function ($app) {
            return new Notifier(
                [
                    'email' => $app->make(EmailSender::class),
                ],
                $app->make(MessageCreator::class)
            );
        });

        $this->app->singleton(MessageCreator::class, BladeMessageCreator::class);
    }
}
