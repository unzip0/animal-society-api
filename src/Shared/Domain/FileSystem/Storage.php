<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\FileSystem;

interface Storage
{
    public function store(UploadedFile $file): string;

    public function delete(UploadedFile $file): void;

    public function url(UploadedFile $file): ?string;

    public function update(UploadedFile $file): void;
}
