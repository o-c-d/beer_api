<?php

declare(strict_types=1);

namespace App\Application\Command\Biere;

use App\Application\Command\Command;

readonly class BiereImport implements Command
{
    public function __construct(
        public string $name,
        public int $id,
        public int $breweryId,
        public int $catId,
        public int $styleId,
        public float $alcoholByVolume,
        public int $internationalBitternessUnits,
        public int $standardReferenceMethod,
        public int $universalProductCode,
        public string $filepath,
        public string $description,
        public int $addUser,
        public string $style,
        public string $category,
        public string $brewer,
        public string $address,
        public string $city,
        public string $state,
        public string $country,
        public string $coordinates,
        public string $website,
        ) {
    }
}
