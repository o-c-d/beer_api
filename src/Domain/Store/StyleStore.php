<?php

declare(strict_types=1);

namespace App\Domain\Store;

use App\Entity\Style;

interface StyleStore
{
    public function findOneBy(array $criteria, array $orderBy = null): ?object;

    public function save(Style $checkin): void;
}