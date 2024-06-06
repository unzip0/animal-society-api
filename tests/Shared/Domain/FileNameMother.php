<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Shared\Domain;

final class FileNameMother
{
    /**
     * @todo Require implement allowed file name format
     */
    public static function create(): string
    {
        return 'file_name.jpg';
        // return MotherCreator::random()->filePath;
    }
}
