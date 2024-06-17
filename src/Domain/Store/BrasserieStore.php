<?php

declare(strict_types=1);

namespace App\Domain\Store;

use App\Entity\Brasserie;

interface BrasserieStore
{
    public function findOneBy(array $criteria, array $orderBy = null): ?object;

    public function save(Brasserie $brasserie): void;

    public function countBrasseriesByCountry(): array;
}