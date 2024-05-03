<?php

declare(strict_types=1);

namespace AnimalSociety\Location\Cities\Domain;

class City
{
    public function __construct(
        private readonly CityId $cityId,
        private readonly CityName $name,
        private readonly CityPostalCode $cityPostalCode,
    ) {}

    public function getCityId(): CityId
    {
        return $this->cityId;
    }

    public function getName(): CityName
    {
        return $this->name;
    }

    public function getCityPostalCode(): CityPostalCode
    {
        return $this->cityPostalCode;
    }
}
