<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\Animals;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhoto;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileExtension;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileMimeType;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileName;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFilePath;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceId;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Administration\Animals\Domain\Animal as DomainAnimal;
use AnimalSociety\Administration\Animals\Domain\AnimalAge;
use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Administration\Animals\Domain\AnimalName;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\ModelDomainMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Animals\Animal as ModelAnimal;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class AnimalMapper extends ModelDomainMapper
{
    public function domainToModel(Domain $domain): ModelAnimal
    {
        $model = new ModelAnimal($domain->transform());

        return $model;
    }

    public function modelToDomain(Model $model): Domain
    {
        /** @var ModelAnimal $model */
        $id = new AnimalId($model->id());
        $associationId = new AssociationId($model->associationId());
        $name = new AnimalName($model->name());
        $speciesId = new AnimalSpeciesId($model->speciesId());
        $raceId = new AnimalRaceId($model->raceId());
        $age = new AnimalAge($model->age());
        $available = $model->isAvailable();
        $animalPhoto = $this->getPhotoFromMedia($id);

        $domain = new DomainAnimal(
            animalId: $id,
            animalAssociationId: $associationId,
            animalName: $name,
            animalSpeciesId: $speciesId,
            animalRaceId: $raceId,
            animalAge: $age,
            animalPhoto: $animalPhoto,
            animalAvailable: $available,
        );

        return $domain;
    }

    public function collectionModelToCollectionDomain(Collection $collection): Collection
    {
        return $collection->map(fn (Model $model) => $this->modelToDomain($model));
    }

    private function getPhotoFromMedia(AnimalId $animalId): ?AnimalPhoto
    {
        /** @var Media|null $media */
        $media = Media::where('model_type', ModelAnimal::MORPH_ALIAS) // @phpstan-ignore-line
            ->where('model_id', $animalId->value())
            ->first();

        if ($media === null) {
            return null;
        }

        return AnimalPhoto::create(
            animalId: $animalId,
            animalPhotoFileName: new AnimalPhotoFileName($media->name()),
            animalPhotoFilePath: new AnimalPhotoFilePath($media->getPath()),
            animalPhotoFileExtension: new AnimalPhotoFileExtension(pathinfo($media->name(), PATHINFO_EXTENSION)),
            animalPhotoFileMimeType: new AnimalPhotoFileMimeType($media->mimeType()),
        );
    }
}
