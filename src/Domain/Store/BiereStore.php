<?php

declare(strict_types=1);

namespace App\Domain\Store;

use App\Entity\Biere;

interface BiereStore
{
    public function findOneBy(array $criteria, array $orderBy = null): ?object;

    public function save(Biere $biere): void;

    public function countBieresByStyle(): array;
}