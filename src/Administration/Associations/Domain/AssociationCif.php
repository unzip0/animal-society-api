<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain;

use AnimalSociety\Administration\Associations\Domain\Exception\AssociationCifInvalidException;
use AnimalSociety\Shared\Domain\ValueObject\StringValueObject;
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
            throw AssociationCifInvalidException::create();
        }
    }
}
