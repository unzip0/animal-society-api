<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\Animals;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhoto as DomainAnimalPhoto;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileExtension;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileMimeType;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileName;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFilePath;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoId;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoUrl;
use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\ModelDomainMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Animals\AnimalPhoto as ModelAnimalPhoto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class AnimalPhotoMapper extends ModelDomainMapper
{
    public function domainToModel(Domain $domain): ModelAnimalPhoto
    {
        $model = new ModelAnimalPhoto($domain->transform());

        return $model;
    }

    public function modelToDomain(Model $model): Domain
    {
        /** @var ModelAnimalPhoto $model */
        $id = new AnimalPhotoId($model->id());
        $animalId = new AnimalId($model->animalId());
        $fileName = new AnimalPhotoFileName($model->fileName());
        $filePath = new AnimalPhotoFilePath($model->filePath());
        $fileExtension = new AnimalPhotoFileExtension($model->fileExtension());
        $fileMimeType = new AnimalPhotoFileMimeType($model->fileMimeType());
        $url = new AnimalPhotoUrl($model->url());

        $domain = new DomainAnimalPhoto(
            animalPhotoId: $id,
            animalId: $animalId,
            animalPhotoFileName: $fileName,
            animalPhotoFilePath: $filePath,
            animalPhotoFileExtension: $fileExtension,
            animalPhotoFileMimeType: $fileMimeType,
            animalPhotoUrl: $url,
        );

        return $domain;
    }

    public function collectionModelToCollectionDomain(Collection $collection): Collection
    {
        return $collection->map(fn (Model $model) => $this->modelToDomain($model));
    }
}
