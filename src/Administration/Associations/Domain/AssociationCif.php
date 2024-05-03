<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain;

use AnimalSociety\Shared\Domain\ValueObject\StringValueObject;
use InvalidArgumentException;
use Skilla\ValidatorCifNifNie\Generator;
use Skilla\ValidatorCifNifNie\Validator;

final class AssociationCif extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);

        $validator = new Validator(
            new Generator()
        );

        /**
         * @phpstan-ignore-next-line
         */
        if (!$validator->isValidCif($value)) {
            throw new InvalidArgumentException('Invalid CIF');
        }
    }
}
