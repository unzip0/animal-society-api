<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\FileSystem\Storage;

use AnimalSociety\Shared\Domain\FileSystem\Storage;
use AnimalSociety\Shared\Domain\FileSystem\UploadedFile;
use AnimalSociety\Shared\Infrastructure\FileSystem\MediaModelResolver;

final class LocalFileStorage implements Storage
{
    public function __construct(
        private readonly MediaModelResolver $mediaModelResolver
    ) {}

    public function store(UploadedFile $file): string
    {
        $modelName = $file->getMediaModelName();
        $modelId = $file->getMediaModelId();
        $model = $this->mediaModelResolver->resolve($modelName)->find($modelId); // @phpstan-ignore-line
        $media = $model->addMedia($file->getFilePath())
            ->usingName($file->getFileName())
            ->toMediaCollection($model->defaultMediaCollection());

        return $media->getPath();
    }

    public function delete(?UploadedFile $file): void
    {
        if ($file === null) {
            return;
        }
        $modelName = $file->getMediaModelName();
        $modelId = $file->getMediaModelId();
        $model = $this->mediaModelResolver->resolve($modelName)->find($modelId); // @phpstan-ignore-line
        $mediaCollection = $model->getMedia($model->defaultMediaCollection());
        $mediaCollection->each(fn ($media) => $media->delete());
    }

    public function update(UploadedFile $file): void
    {
        $this->delete($file);
        $this->store($file);
    }

    public function url(UploadedFile $file): ?string
    {
        $modelName = $file->getMediaModelName();
        $modelId = $file->getMediaModelId();
        $model = $this->mediaModelResolver->resolve($modelName)->find($modelId); // @phpstan-ignore-line
        $media = $model->where('file_name', basename($file->getFilePath()))->first();

        if ($media) {
            return $media->getUrl();
        }

        return null;
    }
}
