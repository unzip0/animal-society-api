<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\FileSystem;

use AnimalSociety\Shared\Domain\FileSystem\UploadedFile;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Animals\Animal;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Association;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\User;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

final class MediaModelResolver
{
    /**
     * @var array<string, string>
     */
    private array $medias = [
        UploadedFile::MEDIA_ANIMAL => Animal::class,
        UploadedFile::MEDIA_USER => User::class,
        UploadedFile::MEDIA_ASSOCIATION => Association::class,
    ];

    public function resolve(string $mediaType): Model
    {
        if (!array_key_exists($mediaType, $this->medias)) {
            throw new InvalidArgumentException('Invalid media type');
        }

        /** @phpstan-ignore-next-line */
        return new $this->medias[$mediaType]();
    }
}
