<?php

declare(strict_types=1);

namespace App\Domain\Store;

use App\Entity\Categorie;

interface CategorieStore
{
    public function findOneBy(array $criteria, array $orderBy = null): ?object;

    public function save(Categorie $categorie): void;
}