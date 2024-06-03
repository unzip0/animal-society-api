<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Provider\Laravel;

use AnimalSociety\Shared\Domain\FileSystem\Storage;
use AnimalSociety\Shared\Infrastructure\FileSystem\MediaModelResolver;
use AnimalSociety\Shared\Infrastructure\FileSystem\Storage\LocalFileStorage;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(MediaModelResolver::class);

        $this->app->singleton(Storage::class, function (Container $app) {
            $driver = config('filesystems.default');
            $storageClass = $this->storages()[$driver];

            return new $storageClass(
                $app->make(MediaModelResolver::class)
            );
        });
    }

    /**
     * @return array<string,string>
     */
    private function storages(): array
    {
        return [
            'local' => LocalFileStorage::class,
        ];
    }
}
