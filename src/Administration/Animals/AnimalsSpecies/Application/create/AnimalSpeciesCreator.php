<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsSpecies\Application\create;

use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpecies;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesName;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesRepository;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\Exceptions\AnimalSpeciesNameAlreadyExistsException;

final readonly class AnimalSpeciesCreator
{
    public function __construct(
        private AnimalSpeciesRepository $repository,
    ) {}

    public function __invoke(
        string $id,
        string $name,
    ): void {
        $animalSpecies = AnimalSpecies::create(
            animalSpeciesId: new AnimalSpeciesId($id),
            animalSpeciesName: new AnimalSpeciesName($name),
        );

        $this->checkAnimalsSpeciesConstraints($animalSpecies);

        $this->repository->create($animalSpecies);
    }

    private function checkAnimalsSpeciesConstraints(AnimalSpecies $animalSpecies): void
    {
        $animalSpeciesWithSameName = $this->repository->findOneBy(
            [
                'name' => $animalSpecies->animalSpeciesName()->value(),
            ]
        );

        if ($animalSpeciesWithSameName instanceof AnimalSpecies) {
            throw AnimalSpeciesNameAlreadyExistsException::create();
        }
    }
}
