<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\FileSystem;

interface UploadedFile
{
    public const string MEDIA_ANIMAL = 'animals';
    public const string MEDIA_USER = 'users';
    public const string MEDIA_ASSOCIATION = 'associations';

    public function getFileName(): string;

    public function getFileExtension(): string;

    public function getFileMimeType(): string;

    public function getFilePath(): string;

    public function getMediaModelId(): string;

    public function getMediaModelName(): string;
}
