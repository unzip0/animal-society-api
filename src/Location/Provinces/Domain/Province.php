<?php

declare(strict_types=1);

namespace AnimalSociety\Location\Provinces\Domain;

class Province
{
    public function __construct(
        private readonly ProvinceId $provinceId,
        private readonly ProvinceName $name,
    ) {}

    public function getId(): ProvinceId
    {
        return $this->provinceId;
    }

    public function getName(): ProvinceName
    {
        return $this->name;
    }
}
